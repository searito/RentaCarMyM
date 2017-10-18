<?php
	include_once('func/funciones.php');

	$id = $_POST['btnReportAuto'];

	if (!empty($id)) {
		getRptCarId($id);
	}

	function getRptCarId($id){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

		$consulta = $conectando->prepare("SELECT
												autos.marca AS 'MARCA', autos.modelo AS 'MODELO', autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
												clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
												rentas.dateo AS 'FECHA_SALE', rentas.datei AS 'FECHA_ENTRA', rentas.total AS 'TOTAL'
											FROM rentas
											INNER JOIN autos ON rentas.autoid = autos.id
											INNER JOIN clientes ON rentas.clientid = clientes.id
											WHERE autos.id =".$id." ORDER BY FECHA_SALE DESC");
		$consulta->execute();

		$consultaContador = $conectando->prepare("SELECT
												autos.marca AS 'MARCA', autos.modelo AS 'MODELO', autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
												clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
												rentas.dateo AS 'FECHA_SALE', rentas.datei AS 'FECHA_ENTRA'
											FROM rentas
											INNER JOIN autos ON rentas.autoid = autos.id
											INNER JOIN clientes ON rentas.clientid = clientes.id
											WHERE autos.id =".$id."");
		$consultaContador->execute();

		$consultaVacia = $consultaContador->fetchAll();
		$numFilas = count($consultaVacia);


		$consultAuto = $conectando->prepare("SELECT * FROM autos WHERE id = ".$id."");
		$consultAuto->execute();

		foreach ($consultAuto as $printTitle) {
			$marca = $printTitle['marca'];
			$modelo = $printTitle['modelo'];
			$year = $printTitle['year'];
		}

		$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'MONEY' FROM rentas WHERE autoid = ".$id."");
		$sqlTotal->execute();
		$total = $sqlTotal->rowCount();

		foreach ($sqlTotal as $reading) {
			$dinero = $reading['MONEY'];
		}

		if ($consulta === false) {
			die(mysql_error());
		}else{
			echo "<div class='modal-dialog modal-lg' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>

							<h3 class='modal-title text-center verde' id='myModalLabel'>Reporte De Alquiler De $marca $modelo $year </h3>
							<h4 class='verde upspace text-center'>Total Generado <b>$ $dinero</b></h4>
						</div>

						<div class='modal-body'>
							<div class='table-responsive'>
								<table class='table table-striped'>
									<tr class='info'>
										<th class='text-center' colspan='3'>Cliente Que Lo Alquilo</th>
										<th class='text-center'colspan='3'>Fechas Alquilado</th>
									</tr>

									<tr class='info'>
										<th class='text-center' colspan='2'>Nombre</th>
										<th class='text-center'># DUI</th>
										<th class='text-center'>Fecha De Alquiler</th>
										<th class='text-center'>Fecha Devolución</th>
										<th class='text-center'>Total</th>
									</tr>";

									if ($numFilas != 0) {
										while ($fila = $consulta->fetch()) {
											$nombres = $fila['NOMBRE'];
											$apellidos = $fila['APELLIDO'];
											$dui = $fila['DUI'];
											$dateOut = $fila['FECHA_SALE'];
											$dateInn = $fila['FECHA_ENTRA'];
											$total = $fila['TOTAL'];

											echo "
											<tr>
												<td class='text-center'>$nombres</td>
												<td class='text-center'>$apellidos</td>
												<td class='text-center'>$dui</td>
												<td class='text-center'>$dateOut</td>
												<td class='text-center'>$dateInn</td>
												<td class='text-center'>$ $total</td>
											</tr>";
										}
									}else{
										echo "
											<tr>
												<td class='text-center' colspan='5'><b>No Se Ha Alquilado Este Vehículo</b></td>
											</tr>";
										
									}

						  echo "</table>
							</div>
						</div>

						<div class='modal-footer'>
							<a href='rptcar-pdf.php?id=$id' target='_blank' class='btn btn-default'><span class='glyphicon glyphicon-file'></span> Crear PDF</a>
			      			<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
			      		</div>

					</div>
				  </div>";
		}
	}
?>

