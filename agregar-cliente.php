<?php
	require('header.php');
	require('barra.php');

	$mensaje = null;

	if (isset($_POST['save'])) {
		$nombre = htmlspecialchars($_POST['nombre']);
		$apellido = htmlspecialchars($_POST['apellido']);
		$dui = htmlspecialchars($_POST['dui']);
		$licencia = htmlspecialchars($_POST['licencia']);
		$direccion = htmlspecialchars($_POST['direccion']);
		$celular = htmlspecialchars($_POST['celular']);
		$celular2 = htmlspecialchars($_POST['celular2']);
		$fijo = htmlspecialchars($_POST['fijo']);
		$mail = htmlspecialchars($_POST['mail']);

		$contandoDUI = $conectando->prepare("SELECT count(dui) FROM clientes WHERE dui ='".$dui."'");
		$contandoDUI->execute();
		$duisContados = $contandoDUI->fetchColumn();

		$contandoLic = $conectando->prepare("SELECT count(licencia) FROM clientes WHERE licencia ='".$licencia."'");
		$contandoLic->execute();
		$licsContadas = $contandoLic->fetchColumn();

		#xprint("Total DUI = $duisContados \n Total Licencias = $licsContadas");


		if (strlen($nombre)>40 || strlen($dui)>10 || strlen($licencia)>17 || strlen($direccion)>75 || strlen($celular)>9 || 
			strlen($celular2)>9 || strlen($fijo)>9 || strlen($mail)>40) {
			$mensaje = " ";
			echo "<script> alert('Error, Verifica Datos')</script>";
		}

		elseif ($duisContados > 0 || $licsContadas > 0) {
			/*echo "<script>
			        alert('Datos Repetidos, Verifica Que El D.U.I. o La Licencia Esten Bien Ingresados...');
			        window.location=('agregar-cliente.php');
			      </script>";*/

		      echo "<script>
				  	$(function() {
                  		$('#respuesta').dialog({
		                        resizable: false,
							    height: 'auto',
							    width: 400,
							    modal: true,
		                      	buttons: {
		                        Ok: function() {
		                          $(this).dialog('close');
		                       }
		                     }
		                  });
						
						$('#respuesta').text('Datos Repetidos, Verifica Que El D.U.I. o La Licencia Esten Bien Ingresados');
		            });
					
			      </script>";
		}else{
			$model = new CRUD;
			$model->insertInto = 'clientes';
			$model->insertColumns = 'nombres, apellidos, dui, licencia, direccion, tfijo, tcel, tcel2, email';
			$model->insertValues = "'$nombre', '$apellido', '$dui', '$licencia', '$direccion', '$fijo', '$celular', '$celular2', '$mail'";
			$model->Create();
			$mensaje = $model->mensaje;

			#echo "<script>alert('Cliente Almacenado Correctamente.'); window.location=('client-list.php');</script>";
			echo "<script>
				  	$(function() {
                  		$('#respuesta').dialog({
	                        resizable: false,
						    height: 'auto',
						    width: 400,
						    modal: true,
	                      	buttons: {
		                        Si: function(){
		                        	$(this).dialog(window.location.href = 'agregar-cliente.php');	
		                        },
		                        No: function() {
		                          $(this).dialog(window.location.href = 'client-list.php');
		                       }
	                     	}
		                  });
						
						$('#respuesta').text('Cliente Ingresado Satisfactoriamente. Desea Agregar Uno Nuevo?');
		            });
					
			      </script>";
		}
	}
?>

	<div class="jumbotron">
		<div class="container">
			<h2 class="subtitulo slavo verde centro">Agregar Cliente</h2>

			<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" role="form">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="verde upSpace">Nombres:</label>
							<input type="text" name="nombre" placeholder="Miguel" required autofocus class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">Apellidos:</label>
							<input type="text" name="apellido" placeholder="Alvarado" required class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">D.U.I:</label>
							<input type="text" name="dui" placeholder="04239450-7" required class="form-control">
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

						<div class="form-group">
								<label class="verde upSpace">Número De Licencia:</label>
								<input type="text" name="licencia" placeholder="1205-230692-101-3" required class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">Dirección:</label>
							<input type="text" name="direccion" placeholder="1 AV Sur, #12, B° Dolores, Chinameca" required class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">Teléfono Celular:</label>
							<input type="text" name="celular" placeholder="6356-9832" required class="form-control">
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="verde upSpace">Teléfono Celular Alternativo:</label>
							<input type="text" name="celular2" placeholder="7356-4832"  class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">Teléfono Fijo:</label>
							<input type="text" name="fijo" placeholder="2665-0921"  class="form-control">
						</div>

						<div class="form-group">
							<label class="verde">Correo Electrónico:</label>
							<input type="email" name="mail" placeholder="rentacarm&m@gmail.com"  class="form-control">
							<input type="hidden" name="save">
						</div>
					</div>
				</div>
				
				<div id="respuesta" title="Rentacar M&M"></div>

				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

				<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
					<button type="submit" name="enviar" value="Almacenar" class="btn btn-primary upSpace">
						<span class="glyphicon glyphicon-floppy-save"></span> Almacenar Datos 
					</button>
				</div>

				<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
			</form>
		</div>
	</div>

<?php include_once('footer.php'); ?>