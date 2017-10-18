<?php
	include_once('func/funciones.php');

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$id = $_POST['idTransa'];
	$cliente = $_POST['cliente'];
	$auto = $_POST['auto'];
	$fechaSale = $_POST['alquiler'];
	$fechaEntra = $_POST['devolucion'];
	$fecha1 = date_create($fechaSale);
	$fecha2 = date_create($fechaEntra);
	$totalDias = date_diff($fecha1, $fecha2);
	$dias = $totalDias->format("%a");

	$sqlPrecio = $conectando->prepare("SELECT usd FROM autos WHERE id = ".$auto."");
	$sqlPrecio->execute();

	foreach ($sqlPrecio as $read) {
		$price = $read['usd'];
		$total = $price * $totalDias->format("%a");
	}

	#echo $cliente." ". $auto." ".$fechaSale." ".$fechaEntra;

	$model = new CRUD;
	$model->update = "rentas";
	$model->set = "clientid='$cliente', autoid='$auto', dateo='$fechaSale', datei='$fechaEntra', total='$total'";
	$model->condition = "id='$id'";
	$model->Update();

	echo "<script>
			var days = $dias;
			var gasto = $total;
	      	alert('Transacción Actualizada Correctamente.\\nAlquilado Por '+ days +' Dias\\nTotal Alquiler: $'+ gasto +'.'); 
	      	window.location=('bitacora.php');
      	  </script>";

	/*echo "<script>
			var days = $dias;
			var gasto = $total;
			var mensaje = ('Alquilado Por '+ days +' Dias, Total Alquiler: $'+ gasto +'.'); 

	        $(function() {
                  $('#respuesta').dialog({
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

			$('#respuesta').text(mensaje);
	      </script>";*/
?>
