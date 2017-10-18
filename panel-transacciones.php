<?php
	include_once('header.php');
	include_once('barra.php');
?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="make-rent.php">
						<img src="img/nuevarent.png" title="Rentar Auto" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Rentar</h3>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="actualizarenta.php">
						<img src="img/editar.png" title="Actualizar Transacción" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Actualizar Transacción</h3>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="validar-ingreso.php">
						<img src="img/validar.png" title="Validar Ingreso" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Validar Ingreso</h3>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>