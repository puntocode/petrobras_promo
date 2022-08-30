<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Zona;
use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Estacion;
use App\Models\RazonSocial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cantidad_cupones_hoy = Factura::whereDate('created', Carbon::today())->sum('coupons');
        $clientes = Cliente::where('status', 'live')->get();
        $cantidad_cupones = Factura::all()->sum('coupons');
        $cantidad_clientes = $clientes->count();
        return view('home', compact('cantidad_cupones_hoy', 'cantidad_cupones', 'cantidad_clientes'));
    }

    public function canjes()
    {
        return view('administrador.canjes.lista');
    }

    public function obtener_canjes(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        if($request->get("length") == -1)
        {
            $rowperpage = Cliente::count();
        }
        else
        {
            $rowperpage = $request->get("length");
        }

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Factura::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Factura::select('count(*) as allcount')->where('invoice', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Factura::orderBy($columnName,$columnSortOrder)
          ->where('redeems.invoice', 'like', '%' .$searchValue . '%')
          ->select('redeems.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        $data_arr = array();
        foreach($records as $record){
           $fecha_carga = $record->created;
           $cliente = $record->cliente->first_name .' '. $record->cliente->last_name;
           if($record->estacion)
           {
           	$estacion = $record->estacion->name;
           }
           else
           {
			$estacion = "";
           }
           $monto_factura = $record->total;
           $cupones_generados = $record->coupons;
           if($record->status == 'live')
           {
               $status = 'Activo';
           }
           else
           {
               $status = 'Descalificado';
           }
           $data_arr[] = array(
                'created' => date('d-m-Y h:i:s' , strtotime($fecha_carga)),
                'cliente' => $cliente,
                'estacion' => $estacion,
                'total' => number_format($monto_factura),
                'coupons' => $cupones_generados,
                'estado' => $status,
                "buttons" => '<a href="/edit/canje/'.$record->id.'"><i class="fa fa-edit"></i></a>
                              <a href="/ver/canje/'.$record->id.'"><i class="fa fa-eye"></i></a>
                              <a href="'.$record->image_path.'" target="_blank"><i class="fa fa-image"></i></a>'
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;     
    }
    
    public function editar_canje($id)
    {
        $factura = Factura::find($id);
        return view('administrador.canjes.edit', compact('factura'));
    }

    public function clientes()
    {
        return view('administrador.clientes.lista');
    }

    public function obtener_clientes(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        if($request->get("length") == -1)
        {
            $rowperpage = Cliente::count();
        }
        else
        {
            $rowperpage = $request->get("length");
        }

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Cliente::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Cliente::select('count(*) as allcount')->where('first_name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Cliente::orderBy($columnName,$columnSortOrder)
          ->where('clientes.first_name', 'like', '%' .$searchValue . '%')
          ->select('clientes.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        $data_arr = array();
        
        foreach($records as $record){
           $document = $record->document;
           $name = $record->first_name;
           $coupons = 0;
           if($record->status == 'live')
           {
               $status = 'Activo';
           }
           else
           {
               $status = 'Inhabilitado';
           }
            


           $data_arr[] = array(
                "document" => $document,
                "name" => $name,
                "coupons" => $coupons,
                "status" => $status,
                "button" => '<a href="/cliente/'.$record->id.'"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>',
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

    public function guardar_canje_editado(Request $request)
    {
        $factura = Factura::find($request->cupon_id);
        $factura->coupons = intdiv(str_replace('.', '', $request->monto_factura), 25000);
        $factura->total = str_replace('.', '', $request->monto_factura);
        $factura->status = $request->estado;
        $factura->save();
        return redirect('/canjes');

    }

    public function ver_canje($id)
    {
        $factura = Factura::find($id);
        return view('administrador.canjes.ver', compact('factura'));
    }

    public function estaciones()
    {
        return view('administrador.estaciones.lista');
    }

    public function obtener_estaciones(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        if($request->get("length") == -1)
        {
            $rowperpage = Estacion::count();
        }
        else
        {
            $rowperpage = $request->get("length");
        }

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Estacion::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Estacion::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Estacion::orderBy($columnName,$columnSortOrder)
          ->where('stations.status', 'live')  
          ->where('stations.name', 'like', '%' .$searchValue . '%')
          ->select('stations.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $nombre = $record->name;
            $razon_social = $record->razon_social->name;
            $direccion = $record->address;
            $zona = $record->zona->name;
            $zona_vendedor = $record->zona_venta->name;
            $valida_factura = "NO";
            if($record->spacio1 == 1)
            {
                $spacio1 = 'SI';
            }
            else
            {
                $spacio1 = 'NO';
            }
            $estado = "Activo";


           $data_arr[] = array(
                "name" => $nombre,
                "razon_social" => $razon_social,
                "direccion" => $direccion,
                "zona" => $zona,
                "zona_vendedor" => $zona_vendedor,
                "valida_factura" => $valida_factura,
                "spacio1" => $spacio1,
                "estado" => $estado,
                "button" => '<a href="/estacion/'.$record->id.'"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>',
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    public function razones_sociales()
    {
        return view('administrador.razones_sociales.lista');
    }

    public function obtener_razones_sociales(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        if($request->get("length") == -1)
        {
            $rowperpage = RazonSocial::count();
        }
        else
        {
            $rowperpage = $request->get("length");
        }

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = RazonSocial::select('count(*) as allcount')->count();
        $totalRecordswithFilter = RazonSocial::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = RazonSocial::orderBy($columnName,$columnSortOrder)
          ->where('social_reasons.status', 'live')  
          ->where('social_reasons.name', 'like', '%' .$searchValue . '%')
          ->select('social_reasons.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $nombre = $record->name;
            $ruc = $record->ruc;
            $estado = "Activo";


           $data_arr[] = array(
                "name" => $nombre,
                "ruc" => $ruc,
                "estado" => $estado,
                "button" => '<a href="/estacion/'.$record->id.'"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>',
           );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }

}
