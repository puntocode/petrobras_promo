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

    <div class="container h-75">
        <div class="row h-75">
            <div class="col-xl-6 col-lg-8 d-flex align-items-center mx-auto">
                <div class="text-center w-100">
                    {{-- <h2 class="title-form">Subí la foto de tu factura</h2> --}}

                    <form enctype="multipart/form-data" method="post" class="form-spacio pt-3">
                        <div class="form-group">
                            <label for="nro-factura">N° de Factura</label>
                            <input type="text" class="form-control" id="nro-factura" aria-describedby="nro-factura">
                            <small class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="monto">Monto de factura</label>
                            <input type="text" class="form-control" id="monto" aria-describedby="monto">
                            <small class="form-text text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="nombre">RUC</label>
                            <input type="text" class="form-control" id="ruc" aria-describedby="ruc spacio1">
                            <small class="form-text text-danger"></small>
                        </div>

                        <div class="upload-photo">
                            <input type="file" class="d-none" accept="image/*" id="photo" name="photo" />
                            <p class="text-left">Subí la foto de tu factura</p>
                            <div class="box bg-muted d-flex flex-column justify-content-center">
                                <a onClick="$('#photo').trigger('click')" class="btnfoto">
                                    <img src="{{ asset('images/icons/google-docs.svg') }}" alt="" height="60">
                                </a>
                                <span class="pt-2">Click para subir imagen</span>
                                <small>*Solo serán válidas las fotos de facturas</small>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="d-block" for="nombre">Subí la foto de tu factura</label>
                            <input type="file" accept="image/*" style="position: absolute; top: -10000px" id="photo" name="photo" />
                        </div> --}}



                        <div class="form-group centeronly">
                            <button type="submit" class="btn btn-primary mt-2 mt-md-3 w-75"><span class="h3">Continuar</span>
                                <img class="float-right mt-1 svg-invert" src="{{ asset('images/icons/upload-image.svg') }}" height="22" alt="icono flecha">
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
