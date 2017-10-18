<?php
	require('header.php');
	require('barra.php');

	include_once('func/ez_sql_core.php');
	include_once('func/ez_sql_mysql.php');
	include_once('func/Zebra_Pagination.php');

	$model = new CRUD;
	$model->select = '*';
	$model->from = 'autos';
	$model->Read();
	$rows = $model->rows;

	$connEzCore = new ezSQL_mysql('root', '', 'rentacar', 'localhost');
	$totalAutos = $connEzCore->get_var("SELECT count(*) FROM autos");
	$resultados = 4;

	$paginacion = new Zebra_Pagination();
	$paginacion->records($totalAutos);
	$paginacion->records_per_page($resultados);
	$paginacion->padding(false);

	$autos = $connEzCore->get_results('SELECT * FROM autos LIMIT ' . (($paginacion->get_page() - 1) * $resultados) . ', ' . $resultados);
?>

<div class="jumbotron">
	<div class="container">
		<h2 class="subtitulo slavo verde centro">Lista De Vehiculos</h2>

		<div class="table-responsive"><br>
			<table class="table table-hover">
				<tr class="info">
					<th>Marca</th>
					<th>Modelo</th>
					<th>Año</th>
					<th># De Placa</th>
					<th>Color</th>
					<th>Precio</th>
					<th class="centro">Opciones</th>
				</tr>
				<?php
					foreach ($autos as $imprimiendo){
						$estado = $imprimiendo->disponible;

						switch ($estado) {
							case '0':
								echo "<tr>
									  	  <td>$imprimiendo->marca</td>
									  	  <td>$imprimiendo->modelo</td>
									  	  <td>$imprimiendo->year</td>
									  	  <td>$imprimiendo->placa</td>
									  	  <td>$imprimiendo->color</td>
									  	  <td>"."$ ".$imprimiendo->usd."</td>
									  	  <td class='text-center'>
									  	  	<a href='updating-auto.php?id=$imprimiendo->id' class='btn btn-primary'>
												<span class='glyphicon glyphicon-refresh'></span> Modificar</a>
											</a>

											<a href='#' class='btn btn-danger'>
												<span class='glyphicon glyphicon-remove'></span> Alquilado</a>
											</a>

											<button type='button' class='btn btn-primary' data-toggle='modal'  data-target='#myModal'
											        value='$imprimiendo->id' id='carinfo' name='carinfo' href='javascript:;'
											        onclick='gettingCarId($(this).val()); return false;'>
												<span class='glyphicon glyphicon-eye-open'></span> + Info
											</button>
									  	  </td>
								      </tr>";
								break;

								case '1':
								echo "<tr>
									  	  <td>$imprimiendo->marca</td>
									  	  <td>$imprimiendo->modelo</td>
									  	  <td>$imprimiendo->year</td>
									  	  <td>$imprimiendo->placa</td>
									  	  <td>$imprimiendo->color</td>
									  	  <td>"."$ ".$imprimiendo->usd."</td>
									  	  <td class='text-center'>
									  	  	<a href='updating-auto.php?id=$imprimiendo->id' class='btn btn-primary'>
												<span class='glyphicon glyphicon-refresh'></span> Modificar</a>
											</a>

											<a href='alquiloc.php?id=$imprimiendo->id' class='btn btn-success'>
												<span class='glyphicon glyphicon-share'></span> Alquilar</a>
											</a>
											
											<button type='button' class='btn btn-info' value='$imprimiendo->id' 
											        href='javascript:;' onclick='aTallerId($(this).val()); return false;' id='btntaller'>
												<span class='glyphicon glyphicon-wrench'></span> A Taller</a>
											</button>
											
											<button type='button' class='btn btn-primary' data-toggle='modal'  data-target='#myModal'
											        value='$imprimiendo->id' id='carinfo' name='carinfo' href='javascript:;'
											        onclick='gettingCarId($(this).val()); return false;'>
												<span class='glyphicon glyphicon-eye-open'></span> + Info
											</button>
											
									  	  </td>
								      </tr>";
								break;

								case '2':
								echo "<tr>
									  	  <td>$imprimiendo->marca</td>
									  	  <td>$imprimiendo->modelo</td>
									  	  <td>$imprimiendo->year</td>
									  	  <td>$imprimiendo->placa</td>
									  	  <td>$imprimiendo->color</td>
									  	  <td>"."$ ".$imprimiendo->usd."</td>
									  	  <td class='text-center'>
									  	  	<a href='updating-auto.php?id=$imprimiendo->id;' class='btn btn-primary'>
												<span class='glyphicon glyphicon-refresh'></span> Modificar</a>
											</a>
											
											<button type='button' class='btn btn-info' value='<?php echo $imprimiendo->id;?>' id='btntaller'>
												<span class='glyphicon glyphicon-wrench'></span> En Taller </a>
											</button>
											
											<button type='button' class='btn btn-primary' data-toggle='modal'  data-target='#myModal'
											        value='$imprimiendo->id' id='carinfo' name='carinfo' href='javascript:;'
											        onclick='gettingCarId($(this).val()); return false;'>
												<span class='glyphicon glyphicon-eye-open'></span> + Info
											</button>
											
									  	  </td>
								      </tr>";
								break;
						}
					}
				?>
			</table>
			<?php $paginacion->render(); ?>
			
			<div id="respuesta" title="Rentacar M&M"></div>

			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12"></div>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
				<a href="car-list-pdf.php" target="_blank" class="btn btn-danger"><span class="glyphicon glyphicon-file"></span> Crear PDF</a>
			</div>

			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			 	
			</div>
		</div>
	</div>
</div>

<?php
	require('footer.php');
?>


<script>
	function aTallerId(btntaller){
		var valorAutoId = {
			"btntaller" : btntaller
		};

		$.ajax({
			type: "POST",
			url: "enviotaller.php",
			data: valorAutoId,
			dataType: "html",
			beforeSend: function(){
				$("#respuesta").html('Procesando');
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