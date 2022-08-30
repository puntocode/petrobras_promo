@extends('layouts.app')

@section('content')
{{-- <x-banner title="Registrate"></x-banner> --}}
<section class="banner">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col text-center">
                <h1 class="text-warning">Registrate</h1>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row py-4 py-md-5">
        <div class="col-xl-6 col-lg-8 d-flex align-items-center mx-auto">
            <div class="text-center w-100">
                <form method="POST" action="/registrar_concursante" class="form-spacio" autocomplete="off">
                @csrf
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input required name="nombre" required type="text" class="form-control" id="nombre" aria-describedby="nombre participante">
                  <small class="form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label for="nombre">Apellido</label>
                    <input name="apellido" required type="text" class="form-control" id="apellido" aria-describedby="apellido participante">
                    <small class="form-text text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Teléfono</label>
                    <input required name="telefono" type="number" class="form-control" id="telefono" aria-describedby="telefono participante">
                    <small class="form-text text-danger"></small>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Correo</label>
                    <input required name="correo" required type="email" class="form-control" id="email" aria-describedby="email participante">
                    <small class="form-text text-danger"></small>
                  </div>
                <div class="form-group text-left d-flex align-items-center mb-2">
                  <input required type="checkbox" class="form-check-input m-0" name="">
                  <label class="pl-4 pt-2 label-check" for="checkBases"><a class="text-decoration-none" href="/bases-y-condiciones" target="_blank"><span class="h5 text-black-50">Acepto las Bases y Condiciones</span> </a> </label>
                </div>
                <button type="submit" class="btn btn-primary mt-2 mt-md-3 w-75"><span class="h3 align-middle">Continuar</span>
                    <img class="float-right align-middle svg-invert" src="{{ asset('images/icons/flecha-derecha.svg') }}" height="22" alt="icono flecha">
                </button>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
