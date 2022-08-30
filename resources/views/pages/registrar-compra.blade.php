@extends('layouts.app')

@section('content')
    {{-- <x-banner title="Registrá tu compra"></x-banner> --}}
    <section class="banner">
        <div class="container h-100">
            <div class="row d-flex align-items-center h-100">
                <div class="col text-center">
                    <h1 class="text-warning">Registrá tu compra</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="container h-75">
        <div class="row h-75 py-5">
            <div class="col-xl-6 col-lg-8 d-flex align-items-center mx-auto">
                <div class="text-center w-100">
                    <h2 class="title-form">Ingresá tu número de documento de identidad</h2>
                    <form class="form-spacio">
                        <div class="form-group">
                          {{-- <label for="ci">Ingresá tu número de documento de identidad</label> --}}
                          <input type="number" class="form-control text-center" id="cliente_documento" aria-describedby="cedula" autocomplete="off">
                          <small id="error" class="form-text text-rose"></small>
                        </div>
                        <button type="button" class="btn btn-primary mt-2 mt-md-3 w-75 validar_documento"><span class="h3 align-middle">Continuar</span>
                            <img class="float-right mt-1 svg-invert" src="{{ asset('images/icons/flecha-derecha.svg') }}" height="20" alt="icono flecha">
                        </button>
                      </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name = "csrf-token"]').attr('content')
                }
            });

            $(".validar_documento").click(function()
            {
                if($("#cliente_documento").val() != '' && $("#cliente_documento").val() != null)
                {
                    $.ajax({
                        type:'POST',
                        url: '/verificar_es_cliente',
                        data:
                        {
                            cliente_documento : $("#cliente_documento").val(),
                        },
                        cache: false,
                        dataType: 'json',
                        success:function(data){
                            dataLayer.push({ 'event':'formok' });
                            console.log(data);
                            if(data['code'] == 1)
                            {
                                location.href = '/registrar-factura'
                            }
                            else
                            {
                                location.href = '/registrar-participante'
                            }
                        },
                        error: function(data){

                        }
                    });
                }
                else
                {
                    //alert('Debe de ingresar un numero de documento');
                    Swal.fire({
                        title: 'Error!',
                        text: 'Debe de ingresar un número de documento',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })
                }
            });
            $("#cliente_documento").keyup(function(event)
            {
                if(event.keyCode == 13)
                {
                    event.preventDefault();
                    $(".validar_documento").trigger('click');
                }
            });
            $(document).on("keypress", 'form', function (e) {
                var code = e.keyCode || e.which;
                if (code == 13) {
                    e.preventDefault();
                    return false;
                }
            });
        })
    </script>
@endsection
