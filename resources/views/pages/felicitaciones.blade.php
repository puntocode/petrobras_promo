@extends('layouts.app')

@section('content')
{{-- <x-banner title="¡Felicitaciones!"></x-banner> --}}
<section class="banner">
    <div class="container h-100">
        <div class="row d-flex align-items-center h-100">
            <div class="col text-center">
                <h1 class="text-warning">¡Felicitaciones!</h1>
            </div>
        </div>
    </div>
</section>

<div class="container h-75">
    <div class="row d-flex align-items-center h-75">
        <div class="col-md-10 mx-auto text-center congratulations">
            <h2>Ya estás participando</h2>
            @if ($ultimo_acumulado == 1)
                <p class="h3">Has acumulado {{$ultimo_acumulado}} nuevo cupón.</p>
            @else
                <p class="h3">Has acumulado {{$ultimo_acumulado}} nuevos cupones.</p>
            @endif

            <div class="bg-muted p-3 mt-3">
                @if ($total_cupones == 1)
                    <span class="h5 text-cupon">Actualmente tenés {{$total_cupones}} cupón acumulado.</span>
                @else
                    <span class="h5 text-cupon">Actualmente tenés {{$total_cupones}} cupones acumulados.</span>
                @endif
            </div>

            <a class="btn btn-primary mt-5 button-home w-50" href="/">Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
