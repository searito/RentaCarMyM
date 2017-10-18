<?php  
	include_once('header.php');
	include_once('barra.php');


	$hoy = date('Y-m-d');

	$consultaDev = $conectando->prepare("SELECT autos.id AS 'ID', autos.marca AS 'MARCA', autos.modelo AS 'MODELO', autos.`year` AS 'ANIO', autos.placa AS 'MATRICULA',
												MAX(rentas.id) AS 'RENTID', MAX(rentas.dateo) AS 'ALQ', MAX(rentas.datei) AS 'DEV', 
												DATEDIFF(MAX(rentas.datei),'".$hoy."') AS 'DIAS_RETRASO'
										 FROM autos
										 INNER JOIN rentas ON rentas.autoid = autos.id
										 WHERE disponible = 0
										 GROUP BY ID
										 ORDER BY DEV ASC");
	$consultaDev->execute();
	$contandoCons = $consultaDev->rowCount();

	date_default_timezone_set('America/El_Salvador');
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Validar Devolución</h2>
		<p class="slavo verde centro">Autos Alquilados</p>

		<div class="table-responsive">
			<table class="table table-hover">
				<tr class="active">
					<th class="text-center">Auto</th>
					<th class="text-center"># Matrícula</th>
					<th class="text-center">Fecha Alquiler</th>
					<th class="text-center">Fecha Devolución</th>
					<th class="text-center">Dias Restantes / Retrasados</th>
					<th class="text-center">Validar</th>
				</tr>
			<?php 
					
				if ($contandoCons != 0) {

					while ($linea = $consultaDev->fetch()) {
						$id = $linea['RENTID'];
						$marca = $linea['MARCA'];
						$modelo = $linea['MODELO'];
						$year = $linea['ANIO'];
						$matricula = $linea['MATRICULA'];
						$alq = $linea['ALQ'];
						$dev = $linea['DEV'];
						$plazo = $linea['DIAS_RETRASO'];

						if ($plazo < 0) {
							$plazop = abs($plazo);
							echo "<tr class='danger'>
						 			<td class='text-center'>$marca $modelo $year</td>
						 			<td class='text-center'>$matricula</td>
						 			<td class='text-center'>$alq</td>
						 			<td class='text-center'>$dev</td>
						 			<td class='text-center'>$plazop</td>

						 			<td class='text-center'>
						 				<button type='button' value='$id' class='btn btn-primary' id='validar'
					 				        href='javascript:;' onclick='validando($(this).val()); return false;'>
						 					<span class='glyphicon glyphicon-ok'></span>
						 				</button>
						 			</td>
						 	      </tr>";
						}else{
							echo "<tr class='success'>
						 			<td class='text-center'>$marca $modelo $year</td>
						 			<td class='text-center'>$matricula</td>
						 			<td class='text-center'>$alq</td>
						 			<td class='text-center'>$dev</td>
						 			<td class='text-center'>$plazo</td>
						 			<td class='text-center'>
						 				<button type='button' value='$id' class='btn btn-primary' id='validar'
						 				        href='javascript:;' onclick='validando($(this).val()); return false;'>
						 					<span class='glyphicon glyphicon-ok'></span>
						 				</button>
						 			</td>
						 	      </tr>";
						}
				 	}
				}else{
					echo "<tr>
							<td colspan='6' class='text-center'><b>No Hay Ningún Auto Pendiente De Validación</b></td>
					      </tr>";
				}
			?>
			</table>
		</div>
		<div id="respuesta" title="Rentacar M&M"></div>

	</div>
</div>

<?php include_once('footer.php'); ?>

<script>
	function validando(validar){

		var idRenta = {"validar" : validar};

		$.ajax({
			type: "POST",
			url: "devolucion.php",
			data: idRenta,
			dataType: "html",
			beforeSend: function(){
				//$("#respuesta").html('Procesando');
				$(function(){
					$("#respuesta").progressbar({
						value: 100
					});
				});
			},
			error: function(){
				alert('Error En El Proceso');
			},
			success: function(response){
				$("#respuesta").empty();
				$("#respuesta").append(response);
			}
		});	
	}
</script>