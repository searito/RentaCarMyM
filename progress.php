<?php 
	include_once('header.php');
	include_once('barra.php');
?>

<style>
	.texto{
		position: absolute;
		left: 45%;
		top: 4px;
		text-shadow: 1px 1px 0 #999;
	}

	.ui-progressbar{ position: relative; }
	.ui-progressbar .ui-progressbar-value { background-image: url(ui/development-bundle/demos/images/pbar-ani.gif); }
</style>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Barra De Progreso</h2>
		<div id="respuesta">
			
		</div>
	</div>
</div>

<script>
	$(function(){
		var barra = $("#respuesta");

		barra.progressbar({
			value: 100
		});
	});
</script>

<?php  
	include_once('footer.php');
?>