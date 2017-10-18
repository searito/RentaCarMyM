<?php 
	require('header.php');
	require('barra.php');

	if (isset($_REQUEST['id'])) {
		$id = htmlspecialchars($_REQUEST['id']);

		$model = new CRUD;
		$model->select = "*";
		$model->from = "clientes";
		$model->condition = "id = $id";
		$model->Read();
		$filas = $model->rows;

		foreach ($filas as $print) {
			$nombre = $print['nombres'];
			$apellido = $print['apellidos'];
			$dui = $print['dui'];
			$licencia = $print['licencia'];
			$direccion = $print['direccion'];
			$tfijo = $print['tfijo'];
			$tcel = $print['tcel'];
			$tcel2 = $print['tcel2'];
			$email = $print['email'];
		}
	}

	$consultCar = $conectando->prepare("SELECT * FROM autos ORDER BY marca ASC");
	$consultCar->execute();
?>

<script src="js/funcionesJava.js" type="text/javascript"></script>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Rentar Auto</h2>

		<form action="<?php $_SERVER['PHP_SELF'] ?>" role="form" method="POST" id="myform">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Cliente</label>
						<input type="text" name="cliente" value="<?php echo $nombre." ". $apellido." -- ". $dui; ?>" readonly class="form-control">
						<input type="hidden" name="idCliente" id="idCliente" value="<?php echo $id; ?>">
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Auto</label>

						<select name="idAuto" id="idAuto" class="form-control">
							<option value="">Marca, Modelo, # De Matrícula</option>
							<option value=""></option>
							<?php
								while($fila = $consultCar->fetch()){
									echo "<option value=".$fila['id'].">".$fila['marca']." ".$fila['modelo']." -- ".$fila['placa']."</option>";
								}
							?>
						</select>
					</div>
				</div>
			</div>


			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
							<label class="verde upSpace">Fecha De Renta</label>
							<input type="text" name="fechaOut" class="form-control" id="fechaOut">
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Fecha Devolución</label>
						<input type="text" name="fechaInn" class="form-control" id="fechaInn">
					</div>
				</div>
			</div>
			
			<!--div class="alert alert-warning" role="alert" id="procesando"></div-->
			
			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
				<button type="submit" name="enviar" value="Almacenar" class="btn btn-primary upSpace" id="guardar" 
				        href="javascript:;" onclick="enviarDatos($('#idCliente').val(), $('#idAuto').val(), $('#fechaOut').val(), $('#fechaInn').val()); return false;">
					<span class="glyphicon glyphicon-shopping-cart"></span> Rentar Vehículo
				</button>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
		</form>
	</div>
</div>

<?php require('footer.php'); ?>