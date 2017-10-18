<?php  
	include_once('func/funciones.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$fDesde = $_POST['fDesde'];
	$fHasta = $_POST['fHasta'];

	$consultaFecha = $conectando->prepare("SELECT clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
			 									  autos.marca AS 'MARCA', autos.modelo AS 'MODELO',autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
			 									  rentas.dateo AS 'FECHA_SALE', rentas.total AS 'TOTAL'
										   FROM rentas
										   INNER JOIN clientes ON clientid = clientes.id
										   INNER JOIN autos ON autoid = autos.id
										   WHERE dateo BETWEEN '".$fDesde."' AND '".$fHasta."' ORDER BY FECHA_SALE DESC");
	$consultaFecha->execute();

	$contandoFecha = $conectando->prepare("SELECT clientes.nombres AS 'NOMBRE', clientes.apellidos AS 'APELLIDO', clientes.dui AS 'DUI',
			 									  autos.marca AS 'MARCA', autos.modelo AS 'MODELO',autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
			 									  rentas.dateo AS 'FECHA_SALE'
										   FROM rentas
										   INNER JOIN clientes ON clientid = clientes.id
										   INNER JOIN autos ON autoid = autos.id
										   WHERE dateo BETWEEN '".$fDesde."' AND '".$fHasta."' ORDER BY FECHA_SALE DESC");
	$contandoFecha->execute();
	$fechaVacia = $contandoFecha->fetchAll();
	$dateContador = count($fechaVacia);

	$sqlTotal = $conectando->prepare("SELECT SUM(total) AS 'MONEY' FROM rentas WHERE dateo BETWEEN '".$fDesde."' AND '".$fHasta."'");
	$sqlTotal->execute();

	foreach ($sqlTotal as $read) {
		$dinero = $read['MONEY'];
	}



	if ($consultaFecha === false) {
		die(mysql_error());
	}else{
		echo "<div class='modal-dialog modal-lg' role='document'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>

						<h3 class='modal-title text-center verde upSpace' id='myModalLabel'>Reporte De Transacciones Realizadas Desde $fDesde Hasta $fHasta</h3>
						<h5 class='verde text-center'><b>$dateContador</b> Transaccion(es) En Total</h5>
						<h4 class='verde upspace text-center'>Total Generado <b>$ $dinero</b></h4>
					</div>

					<div class='modal-body'>
						<div class='table-responsive'>
							<table class='table table-striped'>
								<tr class='info'>
									<th colspan='3' class='text-center'>Información Del Cliente</th>
									<th colspan='4' class='text-center'>Información Del Auto</th>
									<th class='text-center' colspan='2'></th>
								</tr>

								<tr class='info'>
									<th class='text-center'>Nombres</th>
									<th class='text-center'>Apellidos</th>
									<th class='text-center'># DUI</th>
									<th class='text-center'>Marca</th>
									<th class='text-center'>Modelo</th>
									<th class='text-center'>Año</th>
									<th class='text-center'>Matrícula</th>
									<th class='text-center'>Fecha Alq.</th>
									<th class='text-center'>Total</th>
								</tr>";

							if ($dateContador > 0) {
								while ($filas = $consultaFecha->fetch()) {
									$nombre = $filas['NOMBRE'];
									$apellido = $filas['APELLIDO'];
									$dui = $filas['DUI'];
									$marca = $filas['MARCA'];
									$modelo = $filas['MODELO'];
									$anio = $filas['ANIO'];
									$placa = $filas['MATRICULA'];
									$total = $filas['TOTAL'];
									$fecha = $filas['FECHA_SALE'];

									echo "<tr>
											<td class='text-center'>$nombre</td>
											<td class='text-center'>$apellido</td>
											<td class='text-center'>$dui</td>
											<td class='text-center'>$marca</td>
											<td class='text-center'>$modelo</td>
											<td class='text-center'>$anio</td>
											<td class='text-center'>$placa</td>
											<td class='text-center'>$fecha</td>
											<td class='text-center'>$ $total</td>
									      </tr>";
								}
							}else{
								echo "<tr>
										<td colspan='8' class='text-center'><b>No Se Relalizo Ninguna Transacción Entre $fDesde y $fHasta</b></td>
								      </tr>";
							}

					   echo"</table>
						</div>
					</div>
					<div class='modal-footer'>
		      			<a href='rptfechas-pdf.php?desde=$fDesde&hasta=$fHasta' target='_blank' class='btn btn-default'><span class='glyphicon glyphicon-file'></span> Crear PDF</a>
		      			<button type='button' class='btn btn-danger' data-dismiss='modal'>Cerrar</button>
		      		</div>
				</div>
		      </div>";
	}
?>
