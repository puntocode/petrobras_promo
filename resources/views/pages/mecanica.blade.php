
@extends('layouts.app')

@section('content')
{{-- <x-banner title="Mecánica"></x-banner> --}}
<section class="banner">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col text-center">
                <h1 class="text-warning">Mecánica</h1>
            </div>
        </div>
    </div>
</section>

<div class="container mecanica text-center">

    <div class="row">
        <div class="col-md-10 col-lg-8 mx-auto">
            <h2 class="text-mecanica">Por cada Gs. 25.000 de compras que acumules, generás un cupón.</h2>
        </div>
    </div>

    <div class="row pb-5">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-3">1. Ingresá a promoestaciones.com.py</h3>
                    <img src="{{ asset('images/mecanica-1.webp')}}" alt="" height="450">
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-3">2. Registrá tus datos</h3>
                    <img src="{{ asset('images/mecanica-2.webp')}}" alt="" height="450">
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-3">3. Registrá los datos de tu factura</h3>
                    <img src="{{ asset('images/mecanica-3.webp')}}" alt="" height="450">
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-3">4. Ya estás participando</h3>
                    <img src="{{ asset('images/mecanica-4.webp')}}" alt="" height="450">
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
