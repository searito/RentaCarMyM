<?php
	include_once('func/funciones.php');

	$id = htmlspecialchars($_POST['btntaller']);
	$taller = 2;

	$model = new CRUD;
	$model->update = "autos";
	$model->set = "disponible='$taller'";
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
				
				$('#respuesta').text('Auto Enviado Al Taller');
			});
		  </script>";
?>