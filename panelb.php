<?php
	include_once('header.php');
	include_once('barra.php');
?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<div class="thumbnail">
					<a href="bitacora.php">
						<img src="img/logreg.png" title="Bitácora" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Registro De Transacciones</h3>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<div class="thumbnail">
					<a href="buscarxcliente.php">
						<img src="img/buscar-cliente.png" title="Búsqueda De Clientes" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Búsqueda Por Cliente</h3>
				</div>
			</div>
			
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<div class="thumbnail">
					<a href="buscarxauto.php">
						<img src="img/buscar-auto.png" title="Búsqueda De Autos" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Búsqueda Por <br> Auto</h3>
				</div>
			</div>

			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
				<div class="thumbnail">
					<a href="buscarxfecha.php">
						<img src="img/buscarfechas.png" title="Buscar Por Fechas" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Búsqueda Por Fechas</h3>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>