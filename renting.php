<?php 
	include_once('func/funciones.php');

	date_default_timezone_set('America/El_Salvador');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$idCliente = $_POST['idCliente'];
	$idAuto = htmlspecialchars($_POST['idAuto']);
	$fechaOut = htmlspecialchars($_POST['fechaOut']);
	$fechaInn = htmlspecialchars($_POST['fechaInn']);
	$fechaTran = htmlspecialchars(date("Y/m/d"));
	$noDisponible = 0;
	$fecha1 = date_create($fechaOut);
	$fecha2 = date_create($fechaInn);
	$nDias = date_diff($fecha1, $fecha2);
	$dias = $nDias->format("%a");

	$sqlPrecio = $conectando->prepare("SELECT usd FROM autos WHERE id = ".$idAuto."");
	$sqlPrecio->execute();

	foreach ($sqlPrecio as $read) {
		$price = $read['usd'];
		$total = $price * $nDias->format("%a");
	}

	#echo $idCliente.", ".$idAuto.", ".$fechaOut.", ".$fechaInn.", ".$fechaTran;

	$model = new CRUD;
	$model->insertInto = 'rentas';
	$model->insertColumns = 'clientid, autoid, dateo, datei, datet, total';
	$model->insertValues = "'$idCliente', '$idAuto', '$fechaOut', '$fechaInn', '$fechaTran', '$total'";
	$model->Create();

	$model = new CRUD;
	$model->update = "autos";
	$model->set = "disponible='$noDisponible'";
	$model->condition = "id='$idAuto'";
	$model->Update();

	$mensaje = $model->mensaje;

	/*echo "<script>
	      	var dias = $dias;
	      	var total = $total;
	      	alert('Auto Alquilado Por '+dias+' Dias, \\nTotal Transacción $'+total);
      	  </script>";*/

	      echo "<script>
			var days = $dias;
			var gasto = $total;
			var mensaje = ('Alquilado Por '+ days +' Dias, Total Alquiler: $'+ gasto +'.'); 

	        $(function() {
                  $('#procesando').dialog({
                        resizable: false,
					    height: 'auto',
					    width: 400,
					    modal: true,
                      	buttons: {
                      Ok: function() {
                          $(this).dialog(window.location.href = 'bitacora.php');
                       }
                     }
                  });
            });

			$('#procesando').text(mensaje);
	      </script>";
?>