<?php
	include_once('header.php');
	include_once('barra.php');
?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="car-list.php">
						<img src="img/lista-carros.png" title="Lista De Autos" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Listado De Autos</h3>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="agregar-carro.php">
						<img src="img/agregar-carro.png" title="Añadir Auto" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Agregar Auto</h3>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="buscar-auto.php">
						<img src="img/buscar-auto.png" title="Buscar Auto" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Buscar Auto</h3>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>