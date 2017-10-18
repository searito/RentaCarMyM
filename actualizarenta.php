<?php
	include_once('header.php');
	include_once('barra.php');

	include_once('func/ez_sql_core.php');
	include_once('func/ez_sql_mysql.php');
	include_once('func/Zebra_Pagination.php');

	$connEzCore = new ezSQL_mysql('root', '', 'rentacar');
	$totalTransas = $connEzCore->get_var("SELECT count(*) FROM rentas");
	$mostrarxPag = 5;

	$paginacion = new Zebra_Pagination();
	$paginacion->records($totalTransas);
	$paginacion->records_per_page($mostrarxPag);
	$paginacion->padding(false);

	$transas = $connEzCore->get_results('SELECT
		                                  clientes.nombres AS "Nombres", clientes.apellidos AS "Apellidos", clientes.dui AS "dui",
		                                  autos.marca AS "Marca", autos.modelo AS "Modelo", autos.placa AS "Matricula",
		                                  rentas.dateo AS "FechaSale", rentas.id AS "ID"
	                                      FROM rentas 
										  INNER JOIN clientes ON clientes.id = rentas.clientid
										  INNER JOIN autos ON autos.id = rentas.autoid
										  ORDER BY rentas.id DESC
	                                      LIMIT ' . (($paginacion->get_page() - 1) * $mostrarxPag) . ', ' . $mostrarxPag)

?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Actualizar Renta</h2>
		<h4 class="slavo verde centro">Selecciona La Transacción</h4><br>

		<div class="table-responsive">
			<table class="table table-hover">
				<tr class="success">
					<th colspan="3" class="text-center">Información De Cliente</th>
					<th colspan="3" class="text-center">Datos Del Auto</th>
					<th class="text-center">Fecha</th>
					<th class="text-center"></th>
				</tr>

				<tr class="success">
					<th class="text-center">Nombres</th>
					<th class="text-center">Apellidos</th>
					<th class="text-center"># DUI</th>
					<th class="text-center">Marca</th>
					<th class="text-center">Modelo</th>
					<th class="text-center">Matrícula</th>
					<th class="text-center">Transacción</th>
					<th class="text-center"></th>
				</tr>

			<?php foreach ($transas as $imprimo): ?>
				<tr>
					<td class="text-center"><?php echo $imprimo->Nombres; ?></td>
					<td class="text-center"><?php echo $imprimo->Apellidos; ?></td>
					<td class="text-center"><?php echo $imprimo->dui; ?></td>
					<td class="text-center"><?php echo $imprimo->Marca; ?></td>
					<td class="text-center"><?php echo $imprimo->Modelo; ?></td>
					<td class="text-center"><?php echo $imprimo->Matricula; ?></td>
					<td class="text-center"><?php echo $imprimo->FechaSale; ?></td>
					<td class="text-center">
						<button type="button" class="btn btn-primary" title="Actualizar" value="<?php echo $imprimo->ID; ?>"
						        data-toggle="modal" data-target="#myModal" id="btnUpdate" href="javascript:;"
						        onclick="obtenerIdRenta($(this).val()); return false;">
							<span class="glyphicon glyphicon-refresh"></span>
						</button>
					</td>
				</tr>
			<?php endforeach ?>
			</table>
			<?php $paginacion->render(); ?>
		</div>

		<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
      	</div>

	</div>
</div>

<?php include_once('footer.php'); ?>

<script>
	function obtenerIdRenta (btnUpdate) {
		 var valorId = { "btnUpdate" : btnUpdate};

		 $.ajax({
			type: "POST",
			url: "modalrentaupdate.php",
			data: valorId,
			dataType: "html",
			beforeSend: function(){
				$("#myModal").html('Procesando');
			},
			error: function(){
				alert('Error En El Proceso');
			},
			success: function(response){
				$("#myModal").empty();
				$("#myModal").append(response);
			}
		});	
	}
</script>