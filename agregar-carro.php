<?php  
	include_once('header.php');
	include_once('barra.php');

	$mensaje = null;
	
	
	if (isset($_POST['save'])) {
		$marca = htmlspecialchars($_POST['marca']);
		$modelo = htmlspecialchars($_POST['modelo']);
		$year = htmlspecialchars($_POST['year']);
		$placa = htmlspecialchars($_POST['placa']);
		$color = htmlspecialchars($_POST['color']);
		$tipo = htmlspecialchars($_POST['tipo']);
		$capacidad = htmlspecialchars($_POST['capacidad']);
		$disponible = 1;
		$precio = htmlspecialchars($_POST['precio']);


		$total = $conectando->prepare("SELECT count(placa) FROM autos WHERE placa ='".$placa."'");
		$total->execute();
		$cantidad = $total->fetchColumn();


		if (strlen($marca)>25 && strlen($marca)<3 || strlen($modelo)>25 && strlen($modelo)<3 || strlen($year)>4 && strlen($year)<4 || 
			strlen($placa)>8 && strlen($placa)<7 || strlen($color)>10 && strlen($color)<3 || strlen($tipo)>25 && strlen($tipo)<5 || 
			strlen($capacidad)>2 && strlen($capacidad)<1) {
			
			$mensaje = " ";
		echo "<script>alert('Error, Verifique Datos.')</script>";
		}
		
		elseif ($cantidad != 0) {
			/*echo "<script>
		             alert('El Número De Placa Ya Existe, Por Favor Verifica.');
		             window.location=('agregar-carro.php');
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
						
						$('#respuesta').text('El Número De Placa Ya Existe, Por Favor Verifica.');
		            });
					
			      </script>";
		
		}else{
			$model = new CRUD;
			$model->insertInto = 'autos';
			$model->insertColumns = 'marca, modelo, year, placa, color, tipo, capacidad, disponible, usd';
			$model->insertValues = "'$marca', '$modelo', '$year', '$placa', '$color', '$tipo', '$capacidad', '$disponible', '$precio'";
			$model->Create();
			$mensaje = $model->mensaje;

			echo "<script>
				  	$(function() {
                  		$('#respuesta').dialog({
		                        resizable: false,
							    height: 'auto',
							    width: 400,
							    modal: true,
		                      	buttons: {
		                        	Si: function(){
		                        		$(this).dialog(window.location.href = 'agregar-carro.php');
		                        	},

			                        No: function() {
			                          $(this).dialog(window.location.href = 'car-list.php');
			                       }
		                     }
		                  });
						
						$('#respuesta').text('Auto Ingresado Satisfactoriamente. Desea Ingresar Otro?');
		            });
					
			      </script>";
		}
	}
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Agregar Auto</h2>

		<form action="<?php $_SERVER['PHP_SELF'] ?>" role="form" method="POST">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					
					<div class="form-group">
						<label class="verde upSpace">Marca Del Auto</label>
						<input type="text" name="marca" placeholder="Chevrolet" required class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Modelo Del Auto</label>
						<input type="text" name="modelo" placeholder="Impala" class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Año</label>
						<input type="text" name="year" placeholder="1968" class="form-control">
					</div>

					<div class="form-group">
						<label class="verde">Número De Placa</label>
						<input type="text" name="placa" placeholder="P123-456" required class="form-control">
					</div>

				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs12">

					<div class="form-group">
						<label class="verde upSpace">Color Del Auto</label>
						<input type="text" name="color" class="form-control" required placeholder="Negro">
					</div>

					<div class="form-group">
						<label class="verde">Tipo De Auto</label>
						<select name="tipo" class="form-control">
							<option value="">-- Selecciona --</option>
							<option value="Sedan">Sedán</option>
							<option value="Coupe">Coupe</option>
							<option value="Pick-Up">Pick Up</option>
							<option value="Camioneta">Camioneta</option>
						</select>
					</div>

					<div class="form-group">
						<label class="verde">Capacidad De Personas</label>
						<select name="capacidad" class="form-control">
							<option value="">-- Selecciona --</option>
							<option value="1">1 Personas</option>
							<option value="2">2 Personas</option>
							<option value="3">3 Personas</option>
							<option value="4">4 Personas</option>
							<option value="5">5 Personas</option>
							<option value="6">6 Personas</option>
							<option value="7">7 Personas</option>
							<option value="8">8 Personas</option>
							<option value="9">9 Personas</option>
							<option value="10">10 Personas</option>
						</select>
					</div>

					<div class="form-group">
						<label class="verde">Precio Diario</label>
						<input type="text" name="precio" placeholder="35.00" required class="form-control">
					</div>

					<input type="hidden" name="save">

				</div>
			</div>

			<div id="respuesta" title="Rentacar M&M"></div>

			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
				<button type="submit" name="enviar" class="btn btn-primary upSpace">
					<span class="glyphicon glyphicon-floppy-save"></span> Almacenar Datos
				</button>
			</div>
			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
		</form>
	</div>
</div>

<?php require('footer.php'); ?>