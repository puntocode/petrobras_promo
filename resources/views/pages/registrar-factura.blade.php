@extends('layouts.app')

@section('content')
    {{-- <x-banner title="Registrá tu factura"></x-banner> --}}
    <section class="banner">
        <div class="container h-100">
            <div class="row d-flex align-items-center h-100">
                <div class="col text-center">
                    <h1 class="text-warning">Registrá tu factura</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row py-4 py-md-5">
            <div class="col-xl-6 col-lg-8 d-flex align-items-center mx-auto">
                <div class="w-100">
                    {{-- <h2 class="title-form">Subí la foto de tu factura</h2> --}}

                    <form id="form" onsubmit="return Validate(this);" enctype="multipart/form-data" method="post" action="/subir-factura" class="form-spacio pt-3" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="nro-factura">N° de Factura</label>
                            <input required name="nro_factura" type="text" class="form-control" id="ruc-input" aria-describedby="nro-factura">
                        </div>

                        <div class="form-group">
                            <label for="monto">Monto de Factura</label>
                            <input required name="monto_factura" type="number" min=25000 class="form-control" id="monto" aria-describedby="monto">
                            <span id="msg-monto" class="color-pink"></span>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Seleccione la estación</label>
                            <select required class="form-control" name="estacion" id="sl-estaciones">
                                <option selected value="0" disabled>Seleccione una estación</option>
                                @foreach ($estaciones as $estacion)
                                    <option value="{{$estacion->id}}">{{$estacion->name. " - " .$estacion->razon_social->ruc}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="upload-photo text-center">
                            <input type="file" class="d-none" accept="image/*" id="photo" name="photo" />
                            <p class="text-left mb-1">Subí la foto de tu Factura</p>
                            <div class="box bg-muted d-flex flex-column justify-content-center">
                                <a style="cursor: pointer" onClick="$('#photo').trigger('click')" class="btnfoto">
                                    <img class="w-100" src="{{ asset('images/icons/upload-image.svg') }}" alt="" height="60">
                                    <span class="pt-2">Click para subir imagen</span>
                                </a>
                                <small class="color-pink">*Solo serán válidas las fotos de facturas</small>
                                <small id="name-image" class="text-success"></small>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="d-block" for="nombre">Subí la foto de tu factura</label>
                            <input type="file" accept="image/*" style="position: absolute; top: -10000px" id="photo" name="photo" />
                        </div> --}}

                        <div class="form-group mt-3 text-center">
                            <button disabled type="submit" class="btn btn-primary mt-2 mt-md-3 w-75 enviar"><span class="h3 align-middle">Continuar</span>
                                <img class="float-right mt-1 svg-invert" src="{{ asset('images/icons/flecha-derecha.svg') }}" height="22" alt="icono flecha">
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="/js/formateo.js"></script>
<script>
    $(function() {
        $.maskerHtml();
        $('#ruc-input').masker("000-000-0000000");
    });

    $('#photo').on('change', function(){
        var foto = $('input[type=file]').val().split('\\').pop();
        $('.color-pink').fadeOut();
        $('#name-image').hide();
        $('#name-image').html(foto);
        $('#name-image').delay(800).show();
        //console.log(foto);
    });

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
    function Validate(oForm) {
        console.log(oForm);

        var arrInputs = oForm.getElementsByTagName("input");
        for (var i = 0; i < arrInputs.length; i++) {
            var oInput = arrInputs[i];
            if (oInput.type == "file") {
                var sFileName = oInput.value;
                if (sFileName.length > 0) {
                    var blnValid = false;
                    for (var j = 0; j < _validFileExtensions.length; j++) {
                        var sCurExtension = _validFileExtensions[j];
                        if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                            blnValid = true;
                            break;
                        }
                    }

                    if (!blnValid) {
                        //Aca debe de ir tu validacion en caso de que la no sea una imagen lo que cargo el cliente
                        //alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                        Swal.fire({
                            title: 'Error!',
                            text: 'Debe cargar un archivo de tipo IMAGEN',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                        return false;
                    }
                }else
                {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Debe de adjuntar una foto de su factura.',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    return false;
                }
            }
        }

        var slEstaciones = $('#sl-estaciones').val();
        if(slEstaciones < 1){
            Swal.fire({
                title: 'Error!',
                text: 'Debe de seleccionar una estación.',
                icon: 'error',
                confirmButtonText: 'Ok'
            })
            return false;
        }

        return true;
    }


</script>

<script>
    $("#ruc-input").change(function()
    {
        $.ajax({
            type:'GET',
            url: '/verificar_nro_factura',
            data:
            {
                nro_factura : $(this).val(),
            },
            cache: false,
            dataType: 'json',
            success:function(data){
                console.log(data);
                if(data['cantidad'] > 0)
                {
                    //alert('El número de factura ya fue registrado');
                    Swal.fire({
                        title: 'Error!',
                        text: 'El número de factura ya fue registrado',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                    $(".enviar").attr('disabled', true);
                }
                else
                {
                    $(".enviar").attr('disabled', false);
                }
            },
            error: function(data){
                //alert('Lo sentimos no se ha podido procesar el pedido.');
                Swal.fire({
                    title: 'Error!',
                    text: 'Lo sentimos no se ha podido procesar el pedido.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
            }
        });
    });

    $("#sl-estaciones").select2();

    $('#monto').on('keyup', function() {
        if(this.value.length >= 6){
            $('#msg-monto').html('Tené en cuenta que solo son válidas las facturas de compras de Spacio1').delay(3500).fadeOut();
        }
    });

</script>
@endsection

