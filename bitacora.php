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
		                                  rentas.dateo AS "FechaSale", rentas.datei AS "FechaEntra", rentas.total AS "DINERO"
	                                      FROM rentas 
										  INNER JOIN clientes ON clientes.id = rentas.clientid
										  INNER JOIN autos ON autos.id = rentas.autoid
										  ORDER BY rentas.id DESC
	                                      LIMIT ' . (($paginacion->get_page() - 1) * $mostrarxPag) . ', ' . $mostrarxPag)
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Bitácora De Rentas</h2>

		<div class="table-responsive"><br>
			<table class="table table-hover">
				<tr class="success">
					<th colspan="3" class="centro">Cliente</th>
					<th colspan="3" class="centro">Auto</th>
					<th colspan="3" class="centro">Transacción</th>
				</tr>

				<tr class="success">
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>D.U.I.</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>#Placa</th>
					<th>Fecha Renta</th>
					<th>Fecha Entrega</th>
					<th>Total</th>
				</tr>

				<?php foreach ($transas as $imprimo): ?>
					<tr>
						<td><?php echo $imprimo->Nombres; ?></td>
						<td><?php echo $imprimo->Apellidos; ?></td>
						<td><?php echo $imprimo->dui; ?></td>
						<td><?php echo $imprimo->Marca; ?></td>
						<td><?php echo $imprimo->Modelo; ?></td>
						<td><?php echo $imprimo->Matricula; ?></td>
						<td><?php echo $imprimo->FechaSale; ?></td>
						<td><?php echo $imprimo->FechaEntra; ?></td>
						<td><?php echo "$ ".$imprimo->DINERO; ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php $paginacion->render(); ?>

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<a href="bitacora-pdf.php" target="_blank" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Crear PDF</a>
			</div>
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>