<?php 
	include_once('header.php');
	include_once('barra.php');

	include_once('func/ez_sql_core.php');
	include_once('func/ez_sql_mysql.php');
	include_once('func/Zebra_Pagination.php');

	$connEzCore = new ezSQL_mysql('root', '', 'rentacar');
	$totalTransas = $connEzCore->get_var("SELECT count(delay) FROM rentas");
	$mostrarxPag = 5;

	$paginacion = new Zebra_Pagination();
	$paginacion->records($totalTransas);
	$paginacion->records_per_page($mostrarxPag);
	$paginacion->padding(false);

	$transas = $connEzCore->get_results('SELECT clientes.nombres AS "NOM", clientes.apellidos AS "APE",
										        autos.marca AS "MAR", autos.modelo AS "MOD", autos.year AS "ANO", autos.placa AS "MAT",
											    DATE_FORMAT(rentas.dateo,"%d-%m-%Y") AS "FS", DATE_FORMAT(rentas.realinndate,"%d-%m-%Y") AS "FE", 
											    rentas.delay AS "DEL", rentas.mora AS "MOR", rentas.totalcmora AS "TCM", rentas.totaldelay AS "TG"
										 FROM rentas
										 INNER JOIN clientes ON rentas.clientid = clientes.id
										 INNER JOIN autos ON rentas.autoid = autos.id
										 WHERE delay > 0
										 ORDER BY dateo DESC
	                                     LIMIT ' . (($paginacion->get_page() - 1) * $mostrarxPag) . ', ' . $mostrarxPag);



	/*$sqlFechas = $conectando->prepare("SELECT id AS 'COD', datei AS 'FechaEntra'
										FROM rentas 
										WHERE datei BETWEEN NOW() AND DATE_ADD(NOW(),INTERVAL 7 DAY) ");
	$sqlFechas->execute();
	$contandoSQL = $sqlFechas->rowCount();*/
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Registro De Moras</h2>
		<p class="slavo verde centro">Autos Alquilados</p>

		<div class="table-responsive"><br>
			<table class="table table-hover">
				<tr class="success">
					<th class="text-center" rowspan="2" style="vertical-align: middle;">Auto</th>
					<th class="text-center" rowspan="2" style="vertical-align: middle;">Cliente</th>
					<th class="text-center" colspan="6">Detalles Mora</th>
				</tr>
				<tr class="success">
					
					<th class="text-center">Fecha Alq.</th>
					<th class="text-center">Fecha Dev.</th>
					<th class="text-center">Retraso</th>
					<th class="text-center">Alq.</th>
					<th class="text-center">Mora</th>
					<th class="text-center">Total</th>
				</tr>

				<?php foreach ($transas as $load): ?>
					<tr>
						<td><?php echo $load->NOM ." ". $load->APE; ?></td>
						<td><?php echo $load->MAR ." ". $load->MOD ." ". $load->ANO; ?></td>
						<td><?php echo $load->FS; ?></td>
						<td><?php echo $load->FE; ?></td>
						<td><?php echo $load->DEL." Días"; ?></td>
						<td class="text-right"><?php echo "$ ".$load->TCM; ?></td>
						<td class="text-right"><?php echo "$ ".$load->MOR; ?></td>
						<td class="text-right"><?php echo "$ ".$load->TG; ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php $paginacion->render(); ?>

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<a href="mora-pdf.php" target="_blank" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Crear PDF</a>
			</div>

		</div>
	</div>
</div>

<?php require('footer.php'); ?>