<?php  
	include_once("func/funciones.php");

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();

	$id = $_POST["btnUpdate"];

	$sql = $conectando->prepare("SELECT
                                  clientes.id AS 'idCliente', clientes.nombres AS 'Nombres', clientes.apellidos AS 'Apellidos', clientes.dui AS 'dui',
                                  autos.id AS 'idAuto', autos.marca AS 'Marca', autos.modelo AS 'Modelo', autos.placa AS 'Matricula',
                                  rentas.id AS 'idRenta', rentas.dateo AS 'FechaSale', rentas.datei AS 'FechaEntra'
                                  FROM rentas 
								  INNER JOIN clientes ON clientes.id = rentas.clientid
								  INNER JOIN autos ON autos.id = rentas.autoid
								  WHERE rentas.id = ".$id."");
	$sql->execute();

	$sqlClientes = $conectando->prepare("SELECT * FROM clientes");
	$sqlClientes->execute();

	$sqlAutos = $conectando->prepare("SELECT * FROM autos");
	$sqlAutos->execute();

	foreach ($sql as $imprimo) {
		$idRenta = $imprimo['idRenta'];
		$nombres = $imprimo['Nombres'];
		$apellidos = $imprimo['Apellidos'];
		$dui = $imprimo['dui'];
		$marca = $imprimo['Marca'];
		$modelo = $imprimo['Modelo'];
		$placa = $imprimo['Matricula'];
		$fechaOut = $imprimo['FechaSale'];
		$fechaInn = $imprimo['FechaEntra'];
		$idCliente = $imprimo['idCliente'];
		$idAuto = $imprimo['idAuto'];
	}

?>

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

			<h3 class="modal-title text-center verde" id="myModalLabel">Actualizar Transacción </h3>
		</div>

		<div class="modal-body">
			<div class="container">
				<form action="<?php $_SERVER['PHP_SELF'] ?>" role="form" method="POST">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="verde upSpace">Cliente y # DUI</label>
								<select name="cliente" id="cliente" class="form-control">
									<?php
										while($fila = $sqlClientes->fetch()){
											echo "<option value=".$fila['id'].">".$fila['apellidos']." ".$fila['nombres']."  (".$fila['dui'].")"."</option>";
										}
									?>
								</select>
							</div>
						</div>

						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="verde upSpace">Auto y # Matrícula</label>
								<select name="auto" id="auto" class="form-control">
									<?php
										while ($listando = $sqlAutos->fetch()) {
											echo "<option value=".$listando['id'].">".$listando['marca']." ".$listando['modelo']." (".$listando['placa'].")"."</option>";	
										}
									?>
								</select>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="verde upSpace">Fecha Alquiler</label>
								<input type="text" name="alquiler" class="form-control" id="alquiler" value="<?php echo $fechaOut ?>">
							</div>
						</div>

						<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
						
						<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
							<div class="form-group">
								<label class="verde upSpace">Fecha Devolución</label>
								<input type="text" name="devolucion" class="form-control" id="devolucion" value="<?php echo $fechaInn ?>">

								<input type="hidden" id="idTransa" value="<?php echo $idRenta; ?>">
							</div>
						</div>
					</div>

					<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

					<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
						<button type="submit" name="enviar" value="Almacenar" class="btn btn-primary upSpace" id="btnUpdate"
								href="javascript:;" 
								onclick="enviarDatos($('#idTransa').val(), $('#cliente').val(), $('#auto').val(), $('#alquiler').val(), $('#devolucion').val()); return false;">

							<span class="glyphicon glyphicon-refresh"></span> Actualizar
						</button>
					</div>

					<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>
				</form>
			</div>
		</div>

		<div class="modal-footer">
  			<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
  		</div>
	</div>
</div>

<div id="respuesta" title="Transacción Actualizada Correctamente"></div>

<script>
	$(function(){
		$("#alquiler").datepicker({ dateFormat: "yy-mm-dd" });

	});

	$(function(){
		$("#devolucion").datepicker({ dateFormat: "yy-mm-dd" });
	});

	var idCliente = <?php echo $idCliente; ?>;
	var idAuto = <?php echo $idAuto; ?>

	
	$(function(){
		$("#cliente > option[value="+idCliente+"]").attr('selected', 'selected');
		$("#auto > option[value="+idAuto+"]").attr('selected', 'selected');
	});

	
	function enviarDatos(idTransa, cliente, auto, alquiler, devolucion){

		var contenido = {
			"idTransa" : idTransa,
			"cliente" : cliente,
			"auto" : auto,
			"alquiler" : alquiler,
			"devolucion" : devolucion	
		};

		$.ajax({
			type: "POST",
			url: "actrenta.php",
			data: contenido,
			dataType: "html",
			beforeSend: function(){
				$("#respuesta").html('');
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