<?php 
	include_once('func/funciones.php');

	$id = $_POST['minfo'];

	if (!empty($id)) {
		getClientId($id);
	}

	function getClientId($id){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

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

			if ($tcel2 == "") {
				$tcel2 = "No Ingresado";
			}

			if ($tfijo == "") {
				$tfijo = "No Ingresado";
			}

			if ($email == "") {
				$email = "No Ingresado";
			}
		}

		$consultaSql = $conectando->prepare("SELECT * FROM clientes WHERE id ='".$id."'");
		$consultaSql->execute();
		$resultadoSql = $consultaSql->fetchColumn();

		if ($consultaSql === false) {
			die(mysql_error());
		}

		if ($resultadoSql != 0){
			echo "<div class='modal-dialog modal-lg' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>

							<h3 class='modal-title text-center verde' id='myModalLabel'>Información Completa De $nombre $apellido</h3>
						</div>

						<div class='modal-body'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Nombres</span></label>
											<h4>$nombre</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Apellidos</span></label>
											<h4>$apellido</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'># D.U.I.</span></label>
											<h4>$dui</h4>

										</div>
									</div>
								</div>

								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'># Licencia</span></label>
											<h4>$licencia</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Teléfono Fijo</span></label>
											<h4>$tfijo</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Teléfono Celular</span></label>
											<h4>$tcel</h4>

										</div>
									</div>
								</div>

								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Teléfono Celular Alternativo</span></label>
											<h4>$tcel2</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Correo Electrónico</span></label>
											<h4>$email</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Dirección</span></label>
											<h4>$direccion</h4>

										</div>
									</div>
								</div>

							</div>
						</div>

						<div class='modal-footer'>
			      			<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
			      		</div>
					</div>
			      </div>";
		}
	}
?>
