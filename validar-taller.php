<?php 
	include_once('header.php');
	include_once('barra.php');

	$sqlTaller = $conectando->prepare("SELECT * FROM autos WHERE disponible = 2");
	$sqlTaller->execute();
	$contandoSQL = $sqlTaller->rowCount();
?>

<script>
	function vtaller(validar){
		var idcarro = {"validar": validar};

		$.ajax({
			type: "POST",
			url: "validardev.php",
			data: idcarro,
			dataType: "html",
			beforeSend: function(){
				$(function(){
					$("#respuesta").progressbar({
						value: 100
					});
				});
			},

			error: function(){
				$(function(){
					$('#respuesta').dialog({
						resizable: false,
					    height: 'auto',
					    width: 400,
					    modal: true,
					    buttons: {
		                	OK: function(){
		                		$(this).dialog(window.location.href = 'validar-taller.php');
		                	}
		                }
					});
					
					$('#respuesta').text('Hubo Un Problema Con El Servidor');
				});
			},

			success: function(response){
				$("#respuesta").empty();
				$("#respuesta").append(response);
			}
		});
		
	}
</script>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Validar Ingreso De Autos Desde El Taller</h2><br>

		<div class="table-responsive">
			<table class="table table-hover">
				<tr class="info">
					<th class="text-center">Auto</th>
					<th class="text-center">Matrícula</th>
					<th class="text-center">Validar</th>
				</tr>
<?php 
				if ($contandoSQL === 0) {
					echo "<tr>
							<td colspan='3' class='text-center'><b>No Hay Autos Pendientes</b></td>
					      </tr>";
				}else{
					while ($read = $sqlTaller->fetch()) {
						$id = $read['id'];
						$marca = $read['marca'];
						$modelo = $read['modelo'];
						$year = $read['year'];
						$mat = $read['placa'];

						echo "<tr>
								<td class='text-center'>$marca $modelo $year</td>
								<td class='text-center'>$mat</td>
								<td class='text-center'>
									<button type='button' value='$id' class='btn btn-primary' id='validar'
											href='javascript:;' onclick='vtaller($(this).val()); return false;'>
										<span class='glyphicon glyphicon-ok'></span>
									</button>
								</td>
								
						      </tr>";
					}
				}
?>
			</table>
		</div>

		<div id="respuesta" title="Rentacar M&M"></div>
	</div>
</div>

<?php include_once('footer.php'); ?>