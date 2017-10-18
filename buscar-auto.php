<?php 
	require('header.php');
	require('barra.php');
?>

<div class="jumbotron">
	<div class="container">
	<h2 class="subtitulo slavo verde centro">Buscar Según Número De Matrícula, Marca, Modelo O Precio</h2>
		
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-2 col-xs-0"></div>

		<div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
			<div class="form-group">
				<input type="text" name="cliente" id="busqueda" placeholder="Matrícula, Marca, Modelo O Precio" class="form-control">
			</div>
		</div>
	</div>
	
	<div id="resultado">
		<!-- RESULTADO ACA -->
	</div>	

	</div>
</div>

<?php 
	require('footer.php');
?>

<script>
	$(document).ready(function() {
		var consulta;

		$("#busqueda").focus();
		$("#busqueda").keyup(function(e){
			consulta = $("#busqueda").val();

			$.ajax({
				type: "POST",
				url: "searchingcarro.php",
				data: "b="+consulta,
				dataType: "html",
				beforeSend: function(){
					$("#resultado").html("<p alingn='center'><img src='img/6.gif'></p>");
				},
				error: function(){
					alert("Error De Petición De Datos");
				},
				success: function(data){
					$("#resultado").empty();
					$("#resultado").append(data);
				}
			});
		});
	});
</script>