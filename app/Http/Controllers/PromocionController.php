<?php

namespace App\Http\Controllers;

use Image;
use Carbon\Carbon;
use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Estacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromocionController extends Controller
{

    public function inicio()
    {
        session()->put('cliente_documento', 0);
        session()->put('cliente_id', 0);
        return view('pages.index');
    }

    public function registrar_compra()
    {
        return view('pages.registrar-compra');
    }

    public function verificar_es_cliente(Request $request)
    {
        session()->put('cliente_documento', $request->cliente_documento);
        $cliente = Cliente::where('document', $request->cliente_documento)->first();
        if($cliente)
        {
            $response =
            [
                'code' => 1,
                'respuesta' => 'Cliente encontrado',
                'data' => $cliente->id,
            ];
            session()->put('cliente_id', $cliente->id);
        }else
        {
            $response =
            [
                'code' => 0,
                'respuesta' => 'Cliente no encontrado',
                'data' => '',
            ];
        }
        return $response;
    }

    public function registrar_concursante(Request $request)
    {
        $cliente = new Cliente;
        $cliente->document  = session('cliente_documento');
        $cliente->first_name = $request->nombre;
        $cliente->last_name = $request->apellido;
        $cliente->telephone = $request->telefono;
        $cliente->coupons = 0;
        $cliente->agreement = 1;
        $cliente->status = 'live';
        $cliente->created = Carbon::now();
        $cliente->email = $request->email;
        $cliente->average = 0;
        $cliente->register = 'web';
        $cliente->spacio1 = 0;
        $cliente->station = 0;
        $cliente->save();

        session()->put('cliente_id', $cliente->id);

        return redirect('/registrar-factura');
    }

    public function registrar_factura()
    {
        if(session('cliente_id') > 0 )
        {
            $estaciones = Estacion::where('spacio1', 1)->where('status', 'live')->get();
            return view('pages.registrar-factura', compact('estaciones'));
        }
        else
        {
            return redirect('/');
        }
    }

    public function subir_factura(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image      = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();
            $path = public_path().'/uploads/images/facturas/';
            $image->move($path, $fileName);
            //Storage::disk('local')->put('/images/facturas'.'/'.$fileName, $img, 'public');
        }

        $factura = new Factura;
        $factura->total = $request->monto_factura;
        $factura->created = Carbon::now();
        $factura->user_id = session('cliente_id');
        $factura->coupons = intdiv($request->monto_factura, 25000);
        $factura->invoice = $request->nro_factura;
        $factura->station_id = $request->estacion;
        $factura->photo = 1;
        $factura->status = 'live';
        $factura->register = 'web';
        $factura->carry = 0;
        $factura->resto = 0;
        $factura->spacio1 = 0;
        $factura->image_path = '/uploads/images/facturas/'.$fileName;
        $factura->save();
        return redirect('/felicidades');
    }

    public function verificar_nro_factura(Request $request)
    {
        $factura = Factura::where('invoice', $request->nro_factura)->count();

        $response = [
            'cantidad' => $factura,
        ];

        return $response;

    }

    public function felicitaciones()
    {
        if(session('cliente_id') > 0 )
        {
            $ultimo_acumulado = Factura::where('user_id', session('cliente_id'))->where('status', 'live')->orderBy('created', 'DESC')->first()->coupons;
            $total_cupones = Factura::where('user_id', session('cliente_id'))->where('status', 'live')->sum('coupons');
            return view('pages.felicitaciones', compact('ultimo_acumulado', 'total_cupones'));
        }
        else
        {
            return redirect ('/');
        }
    }

}
