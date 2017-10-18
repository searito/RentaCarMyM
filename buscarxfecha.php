<?php  
	include_once('header.php');
	include_once('barra.php');
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Búsqueda De Transacciones Por Fechas</h2>

		<div class="row">
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="form-group">
				<label class="verde upSpace">Desde</label>
					<input type="text" name="fDesde" id="fDesde" class="form-control">
				</div>	
			</div>

			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
			
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
				<div class="form-group">
				<label class="verde upSpace">Hasta</label>
					<input type="text" name="fHasta" id="fHasta" class="form-control">
				</div>	
			</div>
		</div>

		<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

		<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
			<button type="submit" name="enviar" class="btn btn-primary upSpace" id="buscarxFechas" data-toggle="modal"  data-target="#myModal">
				<span class="glyphicon glyphicon-search"></span> Buscar
			</button>
		</div>

		<div class="col-lg-5 col-md-5 col-sm-4 col-xs-4"></div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			 	
		</div>
	</div>
</div>

<?php include_once('footer.php'); ?>

<script>
	$(function(){
		$("#fDesde").datepicker({ dateFormat: "yy-mm-dd" });

	});

	$(function(){
		$("#fHasta").datepicker({ dateFormat: "yy-mm-dd" });
	});

	$("#buscarxFechas").click(function() {
		var fDesde = $("#fDesde").val();
		var fHasta = $("#fHasta").val();

		var contenido = {
			"fDesde" : fDesde,
			"fHasta" : fHasta
		};

		$.ajax({
			type: "POST",
			url: "modalrptfechas.php",
			data: contenido,
			dataType: "html",
			beforeSend: function(){
				$("#myModal").html('Procesando');
			},
			error: function(){
				alert('Error En El Proceso');
			},
			success: function(response){
				$("#myModal").empty();
				$("#myModal").append(response);
			}
		});	
	});
</script>