<?php  
	require('header.php');

	include_once('barra.php');

	$mensaje = null;


	if (isset($_POST['save'])) {
		$usuario = htmlspecialchars($_POST['usuario']);
		$pass  = htmlspecialchars(md5($_POST['pass']));
		$nombre = htmlspecialchars($_POST['nombre']);
		$level = htmlspecialchars($_POST['level']);

		if (strlen($usuario) > 25 || strlen($pass) > 60 || strlen($nombre) > 25 || $level == "") {
			$mensaje = " ";

			echo "<script> alert('Error, Verifique Datos');</script>";
		}else{
			$model = new CRUD;
			$model->insertInto = 'usuarios';
			$model->insertColumns = 'usuario, pass, alias, level';
			$model->insertValues = "'$usuario', '$pass', '$nombre', '$level'";
			$model->Create();
			$mensaje = $model->mensaje;

			echo "<script>alert('Usuario Almacenado Correctamente.');</script>";
		}
	}
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Agregar Usuarios</h2>

		<!-- FORMULARIO DE INGRESO-->
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" role="form">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="usuario" class="verde">Usuario</label>
						<input type="text" name="usuario" placeholder="Introduce Usuario" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="contra" class="verde">Contraseña</label>
						<input type="password" name="pass" placeholder="Introduce Contraseña" required class="form-control" />
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-0 col-xs-0"></div>

				<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
					<div class="form-group">
						<label for="name" class="verde">Nombre</label>
						<input type="text" name="nombre" placeholder="Ingresa Un Nombre" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="level" class="verde">Nivel</label>
						<select name="level" class="form-control">
							<option value="">Selecciona Rango</option>
							<option value="0">Administrador General</option>
							<option value="1">Administrador Delegado</option>
						</select>

						<input type="hidden" name="save">
					</div>
				</div>

				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					<button type="submit" name="enviar" value="Almacenar" class="btn btn-primary upSpace">
						<span class="glyphicon glyphicon-floppy-save"></span> Almacenar Datos 
					</button>
				</div>

				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
				
			</div>
		</form>
		<!-- FIN FORMULARIO -->
	</div>
</div>

<?php include_once('footer.php'); ?>