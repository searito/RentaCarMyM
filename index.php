<?php 

	include_once('header.php');
	include_once('barra.php');
?>

		<div class="jumbotron">
			<div class="container">
			
			<!-- PANEL CENTRAL -->
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="thumbnail">
							<a href="gestionclientes.php">
								<img src="img/logclie.png" title="Gestión De Clientes" class="img-responsive">
							</a>
							<h3 class="mediano verde centro">Gestión De <br> Clientes</h3>
						</div>
					</div>
				

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="thumbnail">
							<a href="gestion-autos.php">
								<img src="img/logauto2.png" title="Gestión De Autos" class="img-responsive">
							</a>
							<h3 class="mediano verde centro">Gestión De <br>Autos</h3>
						</div>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="thumbnail">
							<a href="panel-transacciones.php">
								<img src="img/logrent.png" title="Rentar Vehículo" class="img-responsive">
							</a>
							<h3 class="mediano verde centro">Gestión De Transacciones</h3>
						</div>
					</div>


					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="thumbnail">
							<a href="panelb.php">
								<img src="img/logreg.png" title="Bitácora" class="img-responsive">
							</a>
							<h3 class="mediano verde centro">Bitácora Y Búsquedas</h3>
						</div>
					</div>
				</div>
			<!-- FIN PANEL CENTRAL -->

			
<?php  
	require('footer.php');
?>