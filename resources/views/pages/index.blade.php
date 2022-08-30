@extends('layouts.app')

@section('content')
<section class="index d-flex align-items-center">
    <div class="container py-4 py-md-5">
        <div class="row mb-4">
            <div class="col-8 mx-auto text-center">
                <img class="img-fluid animate__animated animate__fadeInDown" src="{{ asset('images/tu-compañero-spacial.png') }}" alt="tu compañero espacial" style="max-height: 140px">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col text-center">
                <img class="img-fluid animate__animated animate__fadeInUp" src="{{ asset('images/promo.webp') }}" alt="tablet" style="max-height: 310px">
            </div>
        </div>


        <div class="row mb-3 d-flex justify-content-center flex-lg-row-reverse">
            {{-- <div class="col-lg-5 pl-lg-0 text-center text-lg-left"> --}}
            <div class="col-12 col-md-5 pl-lg-0 text-center text-lg-left">
                <a href="/registrar-compra" class="btn btn-registro animate__animated animate__fadeInRight"><span class="h4">Registrá tu compra</span> </a>
            </div>
            <div class="col-9 col-lg-5 pr-lg-0 text-center text-lg-left animate__animated animate__fadeInLeft">
            {{-- <div class="col-lg-4 pr-lg-0 text-center text-lg-left"> --}}
                <span class="texto-promo">Participá del sorteo comprando desde Gs.25.000 en las tiendas</span>
                <img src="{{ asset('images/Logo-Spacio1.png') }}" alt="logo de spacio" height="45">
            </div>
        </div>

    </div>
</section>

<footer class="text-center pt-3">
    <p class="text-black-50 font-italic m-0">Vigencia: 09/04/2021 hasta 07/06/2021</p>
    <a class="pl-2 text-decoration-none" href="/bases-y-condiciones" target="_blank"> Consulta las bases y condiciones</a>
</footer>

@endsection
