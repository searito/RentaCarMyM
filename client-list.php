<?php  
	include_once('header.php');
	include_once('barra.php');

	include_once('func/ez_sql_core.php');
	include_once('func/ez_sql_mysql.php');
	include_once('func/Zebra_Pagination.php');


	$connEzCore = new ezSQL_mysql('root', '', 'rentacar');
	$totalClientes = $connEzCore->get_var("SELECT count(*) FROM clientes");
	$mostrarxPag = 5;

	$paginacion = new Zebra_Pagination();
	$paginacion->records($totalClientes);
	$paginacion->records_per_page($mostrarxPag);
	$paginacion->padding(false);

	$clientes = $connEzCore->get_results('SELECT * FROM clientes ORDER BY apellidos ASC LIMIT ' . (($paginacion->get_page() - 1) * $mostrarxPag) . ', ' . $mostrarxPag)
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Lista De Clientes</h2>			

		<div class="table-responsive"><br>
			<table class="table table-hover">
				<tr class="success">
					<th>Apellidos</th>
					<th>Nombres</th>
					<th>D.U.I.</th>
					<th># De Licencia</th>
					<th>Teléfono Celular</th>
					<th class="centro" colspan="2">Opciones</th>
				</tr>

				<?php foreach ($clientes as $printing): ?>
					<tr>
						<td><?php echo $printing->apellidos; ?></td>
						<td><?php echo $printing->nombres; ?></td>
						<td><?php echo $printing->dui; ?></td>
						<td><?php echo $printing->licencia; ?></td>
						<td><?php echo $printing->tcel; ?></td>
						<td class="centro">
							<a href="modificar-cliente.php?id=<?php echo $printing->id; ?>" class="btn btn-primary">
								<span class='glyphicon glyphicon-refresh'></span> Modificar</a>
							</a>
							
							<a href="alquilandoc.php?id=<?php echo $printing->id; ?>" class="btn btn-success">
							<span class='glyphicon glyphicon-share'></span> Alquilar</a>
							</a>

						<!--PRUEBA MODAL-->
							<button type="button" class="btn btn-primary" data-toggle="modal"  data-target="#myModal" 
							        value="<?php echo $printing->id; ?>" id="minfo" name="minfo" href="javascript:;"
							        onclick="gettingClientId($(this).val()); return false;">
								<span class='glyphicon glyphicon-eye-open'></span> + Info
							</button>
						<!--FIN PRUEBA MODAL-->

						</td>
					</tr>
				<?php endforeach ?>
			</table>
			<?php $paginacion->render(); ?>

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<a href="client-list-pdf.php" target="_blank" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Crear PDF</a>
			</div>

			<!--MODAL ACA-->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			 	
			</div>
			<!---->
		</div>
	</div>
</div>

<?php  
	require('footer.php');
?>