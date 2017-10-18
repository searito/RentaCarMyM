<?php
	include_once('func/funciones.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$id = $_POST['validar'];
	$today = date("Y/m/d");
	$disp = 1;

	$sqlRenta = $conectando->prepare("SELECT id AS 'RENTAID', autoid AS 'IDCAR', dateo, total, DATEDIFF(MAX(rentas.datei),'".$today."') AS 'DIF'
	                                  FROM rentas WHERE id = ".$id."");
	$sqlRenta->execute();

	foreach ($sqlRenta as $leer) {
		$idCarro = $leer['IDCAR'];
		$fechaSale = $leer['dateo'];
		$totalSMora = $leer['total'];
		$diferencia = $leer['DIF'];
	}

	$sqlPrecio = $conectando->prepare("SELECT id AS 'IDAU', usd FROM autos WHERE id = ".$idCarro."");
	$sqlPrecio->execute();

	foreach ($sqlPrecio as $read) {
		$precio = $read['usd'];
	}

	$sqlAuto = $conectando->prepare("SELECT id AS 'CARID' FROM autos WHERE id =".$idCarro."");
	$sqlAuto->execute();

	foreach ($sqlAuto as $load) {
		$idCarro = $load['CARID'];
	}

	if ($diferencia < 0) {
		$valorDif = abs($diferencia);
		$valorDiasLegales = $totalSMora;
		$precio2 = $precio * $valorDif;
		$totalMora = $precio2 * 0.15;
		$totalDiasMora = $precio2 + $totalMora;
		$totalNeto = $totalDiasMora + $valorDiasLegales;

		$model = new CRUD;
		$model->update = "autos";
		$model->set = "disponible='$disp'";
		$model->condition = "id='$idCarro'";
		$model->Update();

		$model = new CRUD;
		$model->update = "rentas";
		$model->set = "realinndate='$today', delay='$valorDif', mora='$totalMora', totalcmora='$totalDiasMora', totaldelay='$totalNeto'";
		$model->condition = "id='$id'";
		$model->Update();

		echo "<script>
				var idrenta = '$id';
				var totalSMora = '$totalSMora';
				var precioDiario = '$precio';
				var dife = '$valorDif';
				var diasExtra = '$precio2';
				var mora = '$totalMora';
				var total = '$totalNeto';

				$(function(){
					$('#respuesta').dialog({
						resizable: false,
					    height: 'auto',
					    width: 400,
					    modal: true,
					    buttons: {
		                	OK: function(){
		                		$(this).dialog(window.location.href = 'validar-ingreso.php');
		                	}
		                }
					});
					
					$('#respuesta').text('Debido a Un Retraso De '+ dife +' Dias De Entrega Se Deberán Cancelar $'+diasExtra+ ' Con Una Mora De $ '+mora+
						                 ' Cancenlando Así Un Total De $'+total);
				});
			  </script>";	
	}else{
		$ontime = 0;
		$model = new CRUD;
		$model->update = "autos";
		$model->set = "disponible='$disp'";
		$model->condition = "id='$idCarro'";
		$model->Update();

		$model = new CRUD;
		$model->update = "rentas";
		$model->set = "realinndate='$today', delay='$ontime', mora='$ontime', totalcmora='$ontime', totaldelay='$ontime'";
		$model->condition = "id='$id'";
		$model->Update();

		echo "<script>
				$(function(){
					$('#respuesta').dialog({
						resizable: false,
					    height: 'auto',
					    width: 400,
					    modal: true,
					    buttons: {
		                	OK: function(){
		                		$(this).dialog(window.location.href = 'validar-ingreso.php');
		                	}
		                }
					});
					
					$('#respuesta').text('Auto Reingresado');
				});
			  </script>";	
	}
?>