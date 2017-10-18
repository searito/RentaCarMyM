<?php
	include_once('func/funciones.php');

	$id = $_POST['carinfo'];

	if (!empty($id)) {
		getCarId($id);
	}

	function getCarId($id){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

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
		}

		if ($filas === false) {
			die(mysql_error());
		}else{
			echo "<div class='modal-dialog modal-lg' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>

							<h3 class='modal-title text-center verde' id='myModalLabel'>Información Completa Del $marca $modelo $year</h3>
						</div>

						<div class='modal-body'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Marca</span></label>
											<h4>$marca</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Modelo</span></label>
											<h4>$modelo</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Año</span></label>
											<h4>$year</h4>

										</div>
									</div>
								</div>

								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'># Matrícula</span></label>
											<h4>$placa</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Color</span></label>
											<h4>$color</h4>

										</div>
									</div>

									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Tipo De Auto</span></label>
											<h4>$tipo</h4>

										</div>
									</div>
								</div>

								<div class='row'>
									<div class='col-lg-4 col-md-4 col-sm-4 col-xs-4'>
										<div class='form-group'>
											<label><span class='label label-primary'>Capacidad Del Auto</span></label>
											<h4>$capacidad Personas</h4>

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