<?php
	include_once('header.php');
	include_once('barra.php');
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Búsqueda De Transacciones Relacionadas Con Autos</h2>

		<p class="text-center upSpace verde">Ingresa Marca, Modelo O # De Matrícula</p>

		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<input type="text" name="auto" placeholder="Marca, Modelo, # Matrícula" class="form-control" id="datosAuto">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
		</div>

		<div id="answer">
 	
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>