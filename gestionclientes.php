<?php
	include_once('header.php');
	include_once('barra.php');
?>
<div class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="client-list.php">
						<img src="img/lista-clientes.png" title="Lista De Clientes" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Listado De Clientes</h3>
				</div>
			</div>

			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="agregar-cliente.php">
						<img src="img/agregar-cliente.png" title="Añadir Cliente" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Agregar Cliente</h3>
				</div>
			</div>
			
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="thumbnail">
					<a href="buscar-cliente.php">
						<img src="img/buscar-cliente.png" title="Buscar Clientes" class="img-responsive">
					</a>
					<h3 class="mediano verde centro">Buscar Cliente</h3>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>