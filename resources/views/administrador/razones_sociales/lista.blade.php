@extends('administrador.layouts.app')
@section('contenido')
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Razones Sociales</h3>
					<div class="row">
						<div class="col-md-12">
							<!-- BORDERED TABLE -->
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Lista de Razones Sociales Habilitadas</h3>
								</div>
								<div class="panel-body">
									<table id="tabla_estaciones" class="table table-bordered">
										<thead>
											<tr>
												<th>Razon Social</th>
												<th>RUC</th>
												<th>Estado</th>
												<th>Acciones</th>
											</tr>
										</thead>
										</tbody>
									</table>
								</div>
							</div>
							<!-- END BORDERED TABLE -->
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
@endsection
@section('extra-script')
    <script type="text/javascript">
		$(document).ready(function(){
			$('#tabla_estaciones').DataTable({
	    		dom:
					"<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
					"<'row'<'col-sm-12'tr>>" +
					"<'row'<'col-sm-5'i><'col-sm-7'p>>",
				processing: true,
				serverSide: true,
				lengthChange: true,
				lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "Todos"]],
    			pageLength: 10,
				ajax: "{{route('obtener_razones_sociales')}}",
				columns: [
					{ data: 'name' },
					{ data: 'ruc' },
					{ data: 'estado' },
					{ data: 'button' },
				],
				buttons: [
					{
						extend: 'excelHtml5',
						className: "btn btn-success",
						exportOptions: {
							columns: [0, 1, 2, 3]
						}
					},
					{
						orientation: 'portrait',
						pageSize: 'LEGAL',
						download: 'open',
						extend: 'pdfHtml5',
						className: "btn btn-warning",
						exportOptions: {
							columns: [0, 1, 2, 3]
						},
						customize: function (doc) {
							doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
							doc.styles.tableBodyEven.alignment = 'center';
							doc.styles.tableBodyOdd.alignment = 'center';
							doc['header'] = (function () {
								return {
									columns: [
										{
											alignment: 'center',
											fontSize: 14,
											text: 'Lista de Canjes - Promo Estaciones'
										}
									],
									margin: 20
								}
							});
						}
					}
				]				
			});
		});
    </script>
@endsection
