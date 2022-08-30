@extends('administrador.layouts.app')
<style>
    /*#myImg {
        transform-origin: top left; 
        -webkit-transform-origin: top left;
        -ms-transform-origin: top left; 
    }

    #img01 {
        transform-origin: top left; 
        -webkit-transform-origin: center; 
        -ms-transform-origin: top left; 
    }
    #myImg.rotate90 {
        transform: rotate(90deg) translateY(-100%);
        -webkit-transform: rotate(90deg) translateY(-100%);
        -ms-transform: rotate(90deg) translateY(-100%);
    }
    #myImg.rotate180 {
        transform: rotate(180deg) translate(-100%,-100%);
        -webkit-transform: rotate(180deg) translate(-100%,-100%);
        -ms-transform: rotate(180deg) translateX(-100%,-100%);
    }
    #myImg.rotate270 {
        transform: rotate(270deg) translateX(-100%);
        -webkit-transform: rotate(270deg) translateX(-100%);
        -ms-transform: rotate(270deg) translateX(-100%);
    }

    #img01.rotate90 {
        transform: rotate(90deg) translateY(-100%);
        -webkit-transform: rotate(90deg) translateY(-100%);
        -ms-transform: rotate(90deg) translateY(-100%);
    }
    #img01.rotate180 {
        transform: rotate(180deg) translate(-100%,-100%);
        -webkit-transform: rotate(180deg) translate(-100%,-100%);
        -ms-transform: rotate(180deg) translateX(-100%,-100%);
    }
    #img01.rotate270 {
        transform: rotate(270deg) translateX(-100%);
        -webkit-transform: rotate(270deg) translateX(-100%);
        -ms-transform: rotate(270deg) translateX(-100%);
    }*/
    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {  
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }    
</style>
@section('contenido')
        <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" style="margin-top: 15px" id="img01" src="{{$factura->image_path}}">
        <div id="caption"></div>
        </div>
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Ver Canje</h3>
					<div class="row">
						<div class="col-md-8">
							<div class="panel">
								<div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="">Cliente</label>
                                            <input type="text" disabled class="form-control" value="{{$factura->cliente->first_name}} {{$factura->cliente->last_name}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Nro. Documento</label>
                                            <input type="text" disabled class="form-control" value="{{number_format($factura->cliente->document, 0, '', '.')}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Fecha de Factura</label>
                                            <input type="text" disabled class="form-control" value="{{$factura->created}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Monto de Factura</label>
                                            <input name="monto_factura" disabled type="text" class="form-control" value="{{number_format($factura->total, 0, '', '.')}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Cupones Generado</label>
                                            <input type="text" disabled class="form-control" value="{{number_format($factura->coupons, 0, '', '.')}}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Cambiar Estado</label>
                                            <select disabled name="estado" class="form-control">
                                                 @if($factura->status == 'live')
                                                     <option selected value="live">Activo</option>
                                                     <option value="cheat">Descalificar</option>
                                                 @else 
                                                     <option value="live">Activo</option>
                                                     <option selected value="cheat">Descalificado</option> 
                                                 @endif 
                                            </select>
                                        </div>
                                        <div class="col-md-12" style="margin-top:20px">
                                            <a href="/canjes" class="btn btn-warning" type="button">Atras</a>
                                            <button class="btn btn-primary pull-right" onclick="rotate()" id="button">Girar Imagen</button>
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
						<div class="col-md-4" >
                            <img style="max-width: 100%; max-height: 100%;" class="img-responsive" alt="Factura" src="{{$factura->image_path}}" id="myImg" />
                        </div>                         
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
@endsection
@section('extra-script')
    <script type="text/javascript">
        function rotate(){
            var angle = ($('#myImg').data('angle') + 90) || 90;
            $('#myImg').css({'transform': 'rotate(' + angle + 'deg)'});
            $('#myImg').data('angle', angle);
            $('#img01').css({'transform': 'rotate(' + angle + 'deg)'});
            $('#img01').data('angle', angle);
        }
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
            modal.style.display = "none";
        }        
    </script>
@endsection        


