<?php
	include_once('header.php');
	include_once('barra.php');


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



	if (isset($_POST['update'])) {
		$id = htmlspecialchars($_POST['id']);
		$nombre = htmlspecialchars($_POST['nombre']);
		$apellido = htmlspecialchars($_POST['apellidos']);
		$dui = htmlspecialchars($_POST['dui']);
		$licencia = htmlspecialchars($_POST['licencia']);
		$direccion = htmlspecialchars($_POST['direccion']);
		$tfijo = htmlspecialchars($_POST['tfijo']);
		$tcel = htmlspecialchars($_POST['tcel']);
		$tcel2 = htmlspecialchars($_POST['tcel2']);
		$email = htmlspecialchars($_POST['email']);

		$model = new CRUD;
		$model->update = "clientes";
		$model->set = "nombres='$nombre', apellidos='$apellido', dui='$dui', licencia='$licencia', direccion='$direccion', tfijo='$tfijo', tcel='$tcel', tcel2='$tcel2', email='$email'";
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
		                          $(this).dialog(window.location.href = 'client-list.php');
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
		<h2 class="subtitulo slavo verde centro">Modificar Datos Del Cliente</h2>
		
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" role="form">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Nombre:</label>
						<input type="text" name="nombre" value="<?php echo $nombre; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde ">Apellidos:</label>
						<input type="text" name="apellidos" value="<?php echo $apellido; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Número De D.U.I:</label>
						<input type="text" name="dui" value="<?php echo $dui; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Número De Licencia:</label>
						<input type="text" name="licencia" value="<?php echo $licencia; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Dirección:</label>
						<input type="text" name="direccion" value="<?php echo $direccion; ?>" required class="form-control">
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>

				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Teléfono Fijo:</label>
						<input type="text" name="tfijo" value="<?php echo $tfijo; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Teléfono Celular:</label>
						<input type="text" name="tcel" value="<?php echo $tcel; ?>" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Teléfono Celular Alternativo:</label>
						<input type="text" name="tcel2" value="<?php echo $tcel2; ?>" class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Correo Electrónico:</label>
						<input type="email" name="email" value="<?php echo $email; ?>" class="form-control">

						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="update">
					</div>
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

<?php include_once('footer.php'); ?>