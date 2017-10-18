<?php  
	include_once('header.php');
	include_once('barra.php');

	$consulta = $conectando->prepare("SELECT * FROM clientes ORDER BY apellidos ASC");
	$consulta->execute();

	$consultCar = $conectando->prepare("SELECT * FROM autos WHERE disponible = 1 ORDER BY marca ASC");
	$consultCar->execute();
?>

<script src="js/funcionesJava.js" type="text/javascript"></script>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Rentar Auto</h2>

		<form action="<?php $_SERVER['PHP_SELF'] ?>" role="form" method="POST" id="myform">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Cliente</label>
						<!--input type="text" name="cliente" required autofocus class="form-control" id="cliente"-->

						<!--#################################################################################-->
						<select name="idCliente" id="idCliente" class="form-control">
							<option value="">Nombre, # De D.U.I.</option>
							<option value=""></option>
							<?php
								while($fila = $consulta->fetch()){
									echo "<option value=".$fila['id'].">".$fila['apellidos']." ".$fila['nombres']."&nbsp;&nbsp;&nbsp;(".$fila['dui'].")</option>";
								}
							?>
							<!--option value="<?php #echo $id ?>"><?php# echo $apellido." ".$nombre." -- ".$dui ?></option-->
						</select>
						<!--#################################################################################-->
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Auto</label>
						<!--input type="text" name="auto" required class="form-control" id="auto"-->
						<select name="idAuto" id="idAuto" class="form-control">
							<option value="">Marca, Modelo, # De Matrícula</option>
							<option value=""></option>

							<?php
								while ($listando = $consultCar->fetch()) {
									echo "<option value=".$listando['id'].">".$listando['marca']." ".$listando['modelo']." &nbsp;&nbsp;&nbsp;(".$listando['placa'].")</option>";	
								}
							?>
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
							<label class="verde upSpace">Fecha De Renta</label>
							<input type="text" name="fechaOut" class="form-control" id="fechaOut">
					</div>
				</div>

				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>

				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<div class="form-group">
						<label class="verde upSpace">Fecha Devolución</label>
						<input type="text" name="fechaInn" class="form-control" id="fechaInn">
					</div>
				</div>
			</div>
			
			<div id="procesando" title="Transacción Realizada Éxitosamente"></div>
			
			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

			<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
				<button type="submit" name="enviar" value="Almacenar" class="btn btn-primary upSpace" id="guardar" 
				        href="javascript:;" onclick="enviarDatos($('#idCliente').val(), $('#idAuto').val(), $('#fechaOut').val(), $('#fechaInn').val()); return false;">
					<span class="glyphicon glyphicon-shopping-cart"></span> Rentar Vehículo
				</button>
			</div>
	
			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
		</form>
	</div>
</div>

<?php include_once('footer.php');?>

