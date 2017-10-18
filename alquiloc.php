<?php
	include_once('header.php');
	include_once('barra.php');

	if (isset($_REQUEST['id'])) {
		$id = htmlspecialchars($_REQUEST['id']);

		$model = new CRUD;
		$model->select = "*";
		$model->from = "autos";
		$model->condition = "id = $id";
		$model->Read();
		$filas = $model->rows;

		foreach ($filas as $print) {
			$marca = $print['marca'];
			$modelo = $print['modelo'];
			$year = $print['year'];
			$placa = $print['placa'];
		}
	}

	$consulta = $conectando->prepare("SELECT * FROM clientes ORDER BY apellidos ASC");
	$consulta->execute();
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

						<select name="idCliente" id="idCliente" class="form-control">
							<option value="">Nombre, # De D.U.I.</option>
							<option value=""></option>
							<?php
								while($fila = $consulta->fetch()){
									echo "<option value=".$fila['id'].">".$fila['apellidos']." ".$fila['nombres']." -- ".$fila['dui']."</option>";
								}
							?>
						</select>
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Auto</label>
						<input type="text" name="auto" value="<?php echo $marca." ". $modelo." ".$year. " --> ".$placa; ?>" readonly class="form-control">
						<input type="hidden" name="idAuto" value="<?php echo $id; ?>" id="idAuto">
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

<?php include_once('footer.php'); ?>