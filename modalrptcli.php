<?php  
	include_once('func/funciones.php');

	$id = $_POST['btnReportClient'];

	if (!empty($id)) {
		getRptClId($id);
	}


	function getRptClId($id){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

		$consulta = $conectando->prepare("SELECT
											clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO',
											autos.marca AS 'MARCA', autos.modelo AS 'MODELO', autos.`year` AS 'ANIO',
											rentas.dateo AS 'FECHA_SALE', rentas.datei AS 'FECHA_ENTRA', rentas.total AS 'TOTAL'
										  FROM rentas
										  INNER JOIN autos ON rentas.autoid = autos.id
										  INNER JOIN clientes ON rentas.clientid = clientes.id
                                          WHERE clientes.id =".$id."");
		$consulta->execute();

		$consultaCliente = $conectando->prepare("SELECT * FROM clientes WHERE id = ".$id."");
		$consultaCliente->execute();

		$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'MONEY' FROM rentas WHERE clientid = ".$id."");
		$sqlTotal->execute();

		foreach ($sqlTotal as $leyendo) {
			$dinero = $leyendo['MONEY'];
		}

		foreach ($consultaCliente as $print) {
			$nombre = $print['nombres'];
			$apellidos = $print['apellidos'];
			/*$marca = $print['MARCA'];
			$modelo = $print['MODELO'];
			$year = $print['ANIO'];
			$dateOut = $print['FECHA_SALE'];
			$dateInn = $print['FECHA_ENTRA'];*/
		}

		if ($consulta === false) {
			die(mysql_error());
		}else{
			echo "<div class='modal-dialog modal-lg' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>

							<h3 class='modal-title text-center verde' id='myModalLabel'>Reporte De Transacciones Realizadas Por $nombre $apellidos</h3>
							<h4 class='verde upspace text-center'>Total Generado <b>$ $dinero</b></h4>
						</div>

						<div class='modal-body'>
							<div class='table-responsive'>
								<table class='table table-striped'>
									<tr class='info'>
										<th colspan='3' class='text-center'>Detalles Del Auto</th>
										<th colspan='3' class='text-center'>Detalles De Fechas</th>
									</tr>

									<tr class='info'>
										<th class='text-center'>Marca</th>
										<th class='text-center'>Modelo</th>
										<th class='text-center'>Año</th>
										<th class='text-center'>Fecha Renta</th>
										<th class='text-center'>Fecha Devolución</th>
										<th class='text-center'>Total</th>
									</tr>";

									while ($fila = $consulta->fetch()) {
										$marca = $fila['MARCA'];
										$modelo = $fila['MODELO'];
										$year = $fila['ANIO'];
										$dateOut = $fila['FECHA_SALE'];
										$dateInn = $fila['FECHA_ENTRA'];
										$total = $fila['TOTAL'];

										echo"<tr>
											<td class='text-center'>$marca</td>
											<td class='text-center'>$modelo</td>
											<td class='text-center'>$year</td>
											<td class='text-center'>$dateOut</td>
											<td class='text-center'>$dateInn</td>
											<td class='text-center'>$ $total</td>
										  </tr>";
									}

								echo"</table>
							</div>
						</div>

						<div class='modal-footer'>
							<a href='oprcnclnt-pdf.php?id=$id' target='_blank' class='btn btn-default'><span class='glyphicon glyphicon-file'></span> Crear PDF</a>
							
							<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
			      		</div>
					</div>
			      </div>
						";


		}
	}


?>