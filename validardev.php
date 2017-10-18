<?php
	include_once('func/funciones.php');

	$id = $_POST['validar'];
	$disp = 1;

	$model = new CRUD;
	$model->update = "autos";
	$model->set = "disponible='$disp'";
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
	                		$(this).dialog(window.location.href = 'car-list.php');
	                	}
	                }
				});
				
				$('#respuesta').text('Auto Reingresado Exitosamente');
			});
		  </script>";
?>