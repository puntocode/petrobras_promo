<!doctype html>
<html lang="es">
<head>
    <title>Petrobras - Tu compañero Spacial</title>

     <!-- Google Tag Manager -->
     <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M5WS2GX');</script>
    <!-- End Google Tag Manager -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:description" content="Participá del sorteo comprando desde Gs. 25.000 en las tiendas Spacio 1">
    <meta property="og:image" content="https://promoestaciones.com.py//images/og-home.jpg"/>
    <meta property="og:site_name" content="Petrobras">
    <meta property="og:title" content="Petrobras: Promo tu Compañero Spacial."/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://promoestaciones.com.py/">
    <meta property="og:locale" content="es_ES" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('images/icons/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body class="bg-white m-0 vh-100 animate__animated animate__fadeIn" ondragstart="return false" onselectstart="return false" oncontextmenu="return false">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M5WS2GX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->  
    
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid d-flex flex-lg-row-reverse">

            <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <img src="{{ asset('images/icons/menu-hamburguesa.svg') }}" alt="menu hamburguesa" height="25">
            </button>

            <div class="logo">
                <a class="navbar-brand" href="https://www.petrobrasdistribucion.com.py/" target="_blank"><img src="{{ asset('images/Logo-Spacio1.png') }}" height="30" alt="logo de spacio 1"></a>
                <a class="navbar-brand" href="https://www.petrobrasdistribucion.com.py/" target="_blank"><img src="{{ asset('images/logo.png') }}" height="30" alt="logo de petrobras"></a>
            </div>

            <div class="collapse navbar-collapse float-left" id="navbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-primary" href="/">INICIO <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mecanica">MECÁNICA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/bases-y-condiciones">BASES Y CONDICIONES</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('script')

      
</body>
</html>
