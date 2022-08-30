<!doctype html>
<html lang="en">

<head>
	<title>PromoEstaciones</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.min.css">
	{{--<link rel="stylesheet" href="/assets/vendor/linearicons/style.css">--}}
	<link rel="stylesheet" href="/assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="/assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="/assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap.min.css"/>
	
	<script src="/assets/vendor/jquery/jquery.min.js"></script>
	<script src="/assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="/assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="/assets/scripts/klorofil-common.js"></script>

	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
	<script src="/js/page.js"></script>
	<script src="https://use.fontawesome.com/62400c4d19.js"></script>

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div style="padding: 16px 39px;" class="brand">
				<a href="/backend"><img style="max-width: 70%" src="/images/logo.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="/assets/img/user.png" class="img-circle" alt="Avatar"> <span>{{\Auth::user()->name}}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="lnr lnr-exit"></i> <span>Salir</span></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>    
                                </li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul id="menu" class="nav menu">
						<li>
							<a href="#users" data-toggle="collapse" class="collapsed {{ (request()->is('usuarios')) ? 'active' : '' }}"><i class="fa fa-users" aria-hidden="true"></i></i> <span>Administradores</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="users" class="collapse">
								<ul class="nav">
									<li><a href="/usuarios" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#estaciones" data-toggle="collapse" class="collapsed {{ (request()->is('estaciones')) ? 'active' : '' }}"><i class="zmdi zmdi-gas-station"></i> <span>Estaciones</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="estaciones" class="collapse {{ (request()->is('estaciones')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/estaciones" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#razones_sociales" data-toggle="collapse" class="collapsed {{ (request()->is('razones_sociales')) ? 'active' : '' }}"><i class="fa fa-handshake-o" aria-hidden="true"></i></i> <span>Razones Sociales</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="razones_sociales" class="collapse {{ (request()->is('razones_sociales')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/razones_sociales" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#zona" data-toggle="collapse" class="collapsed {{ (request()->is('zonas')) ? 'active' : '' }}"><i class="fa fa-globe" aria-hidden="true"></i> <span>Zonas</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="zona" class="collapse {{ (request()->is('zonas')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/Zonas" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#clients" data-toggle="collapse" class="collapsed {{ (request()->is('clinetes')) ? 'active' : '' }}"><i class="fa fa-user" aria-hidden="true"></i><span>Clientes</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="clients" class="collapse {{ (request()->is('clientes')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/clientes" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#cuopons" data-toggle="collapse" class="collapsed {{ (request()->is('canjes')) ? 'active' : '' }}"><i class="fa fa-gamepad" aria-hidden="true"></i></i> <span>Canjes</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="cuopons" class="collapse {{ (request()->is('canjes')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/canjes" class="">Lista</a></li>
								</ul>
							</div>
							<a href="#sorteador" data-toggle="collapse" class="collapsed {{ (request()->is('sorteador')) ? 'active' : '' }}"><i class="fa fa-trophy"></i> <span>Sorteador</span> <i class="icon-submenu fa fa-angle-down"></i></a>
							<div id="sorteador" class="collapse {{ (request()->is('sorteador')) ? 'in' : '' }}">
								<ul class="nav">
									<li><a href="/sorteador" class="">Lista</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
        @yield('contenido')
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">&copy; 2021 <a href="https://capitanlott.com/" target="_blank">Capitan Lott</a>. All Rights Reserved.</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
</body>
 @yield('extra-script')
 {{--<script>
	 $(document).ready(function()
	 {
		$("#menu").click(function(){
			var elements = document.querySelectorAll('.collapsed');
			for (var i = 0; i < elements.length; i++) {
				elements[i].classList.remove('active');
				elements[i].onclick = function (event) {
					console.log("ONCLICK");
					//remove all active class
					removeClassActive();
					if (event.target.innerHTML === this.innerHTML) {
						this.classList.add("active");
					}
				}
			}


		})

		function removeClassActive(){
			for (var i = 0; i < elements.length; i++) {
				elements[i].classList.remove("active");
			}
		}

		function removeClassIn(){
			for (var i = 0; i < elements.length; i++) {
				elements[i].classList.remove("in");
			}
		}

	})
	 
 </script>--}}
</html>
