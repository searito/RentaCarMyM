<?php
	require('header.php');
	require('barra.php');

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
			$color = $print['color'];
			$tipo = $print['tipo'];
			$capacidad = $print['capacidad'];
			$precios = $print['usd'];
		}
	}

	if (isset($_POST['update'])) {
		$id = htmlspecialchars($_POST['id']);
		$marca = htmlspecialchars($_POST['marca']);
		$modelo = htmlspecialchars($_POST['modelo']);
		$year = htmlspecialchars($_POST['year']);
		$placa = htmlspecialchars($_POST['placa']);
		$color = htmlspecialchars($_POST['color']);
		$tipo = htmlspecialchars($_POST['tipo']);
		$capacidad = htmlspecialchars($_POST['capacidad']);
		$price = htmlspecialchars($_POST['precio']);

		$model = new CRUD;
		$model->update = "autos";
		$model->set = "marca='$marca', modelo='$modelo', year='$year', placa='$placa', color='$color', tipo='$tipo', capacidad='$capacidad', usd='$price'";
		$model->condition = "id='$id'";
		$model->Update();

		echo "<script>
				  	$(function() {
                  		$('#respuesta').dialog({
		                        resizable: false,
							    height: 'auto',
							    width: 400,
							    modal: true,
		                      	buttons: {
		                        Ok: function() {
		                          $(this).dialog(window.location.href = 'car-list.php');
		                       }
		                     }
		                  });
						
						$('#respuesta').text('Información Actualizada Correctamente.');
		            });
					
			      </script>";
	}
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Modificar Datos Del Auto</h2>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Marca Del Auto</label>
						<input type="text" name="marca" class="form-control" value="<?php echo $marca; ?>" required>
					</div>

					<div class="form-group">
						<label class="verde">Modelo Del Auto</label>
						<input type="text" name="modelo" class="form-control" value="<?php echo $modelo; ?>" required>
					</div>

					<div class="form-group">
						<label class="verde">Año De Fabricación</label>
						<input type="text" name="year" value="<?php echo $year; ?>" class="form-control" required>
					</div>

					<div class="form-group">
						<label class="verde">Número de Matrícula</label>
						<input type="text" name="placa" value="<?php echo $placa; ?>" class="form-control" required>
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>

				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Color Del Vehículo</label>
						<input type="text" name="color" value="<?php echo $color; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Tipo De Vehículo</label>
						<input type="text" name="tipo" value="<?php echo $tipo; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde ">Capacidad Del Auto</label>
						<input type="text" name="capacidad" value="<?php echo $capacidad; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde ">Precio Diario (USD)</label>
						<input type="text" name="precio" value="<?php echo $precios; ?>" required class="form-control">
					</div>

					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="hidden" name="update">
				</div>
			</div>

			<div id="respuesta" title="Rentacar M&M"></div>

			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					<button type="submit" name="enviar" class="btn btn-primary upSpace">
						<span class="glyphicon glyphicon-refresh"></span> Actualizar Información
					</button>
				</div>
				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
		</form>
	</div>
</div>

<?php require('footer.php'); ?>