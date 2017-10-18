<?php  
	include_once('header.php');
	include_once('barra.php');
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Búsqueda De Transacciones Realizadas Por Clientes</h2><br>

		<p class="text-center upSpace verde">Ingresa El Nombre, # de DUI o # De Licencia Del Cliente</p>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<input type="text" name="cliente" placeholder="Nombre, # De Licencia O DUI" class="form-control" autofocus id="datosCliente">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
		</div>

		<div id="respuesta">
 	
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>