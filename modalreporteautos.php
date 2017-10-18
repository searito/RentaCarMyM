<?php
	include_once('func/funciones.php');

	$buscar = $_POST['bc'];

	if (!empty($buscar)) {
		BuscarAuto($buscar);
	}


	function BuscarAuto($buscar){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

		$cantidadAutos = $conectando->prepare("SELECT COUNT(*) FROM autos 
			                                    WHERE marca LIKE '%".$buscar."%' OR modelo LIKE '%".$buscar."%' 
			                                    OR placa LIKE '%".$buscar."%' ORDER BY marca ASC LIMIT 7");
		$cantidadAutos->execute();

		$consultAutos = $conectando->prepare("SELECT * FROM autos 
			                             		WHERE marca LIKE '%".$buscar."%' OR modelo LIKE '%".$buscar."%' 
			                                    OR placa LIKE '%".$buscar."%' ORDER BY marca ASC LIMIT 7");
		$consultAutos->execute();

		if ($cantidadAutos === false) {
			die(mysql_error());
		}
		elseif ($totalBusqueda = $cantidadAutos->fetchColumn()) {
			echo "<div class='alert alert-success' role='alert'>
				  	$totalBusqueda Resultado(s) Obtenido(s)
			      </div>

			      <div class='table-responsive'>
			      	<table class='table table-hover'>
			      		<tr class='info'>
			      			<th class='text-center'>Auto</th>
			      			<th class='text-center'>Modelo</th>
			      			<th class='text-center'>Año</th>
			      			<th class='text-center'># Matrícula</th>
			      			<th class='text-center'>Acción</th>
			      		</tr>";

			 while ($fila = $consultAutos->fetch()) {
			 	$id = $fila['id'];
			 	$marca = $fila['marca'];
			 	$modelo = $fila['modelo'];
			 	$year = $fila['year'];
			 	$placa = $fila['placa'];

			 	echo "
			 	<tr>
			 		<td class='text-center'>$marca</td>
			 		<td class='text-center'>$modelo</td>
			 		<td class='text-center'>$year</td>
			 		<td class='text-center'>$placa</td>
			 		<td class='text-center'>
			 			<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'
  			         	        value='$id' id='btnReportAuto' href='javascript:;'
  			         	        onclick='valorRptCar($(this).val()); return false;'>
			         	        <span class='glyphicon glyphicon-eye-open'></span> Ver Reporte
  			         	</button>
			 		</td>
			 	</tr>";
			 }

			 echo"
			      	</table>
			      </div>

			      <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
			      	
			      </div>";
		}else{
			echo "<div class='alert alert-danger' role='alert'>
			      	No Se Han Encontrado Resultados Para $buscar
			      </div>";
		}
	}
?>

<script>
	function valorRptCar(btnReportAuto){
		var valorRptAuId = {
			"btnReportAuto" : btnReportAuto
		};

		$.ajax({
			type: "POST",
			url: "modalrptaut.php",
			data: valorRptAuId,
			dataType: "html",
			beforeSend: function(){
				$("#myModal").html('Procesando');
			},
			error: function(){
				alert('Error En El Proceso');
			},
			success: function(response){
				$("#myModal").empty();
				$("#myModal").append(response);
			}
		});	
	}
</script>