<?php 
	include_once('func/funciones.php');
	
	$buscar = $_POST['b'];

	if (!empty($buscar)) {
		BuscarCliente($buscar);
	}


	function BuscarCliente($buscar){
		$conectar = new Conexion();
		$conectando = $conectar->Conectar();

		$reporteCliente = $conectando->prepare("SELECT count(*)
												FROM clientes
												WHERE nombres LIKE '%".$buscar."%' OR dui LIKE '%".$buscar."%' OR apellidos LIKE '%".$buscar."%' ORDER BY clientes.apellidos ASC LIMIT 10");

		$reporteCliente->execute();

		$consulta = $conectando->prepare("SELECT * FROM clientes
											WHERE nombres LIKE '%".$buscar."%' OR dui LIKE '%".$buscar."%' OR apellidos LIKE '%".$buscar."%' ORDER BY clientes.apellidos ASC LIMIT 10");
		$consulta->execute();

		
		if ($reporteCliente === false) {
			die(mysql_error());
		}

		elseif ($totalSql = $reporteCliente->fetchColumn()) {
			echo "<div class='alert alert-success' role='alert'>
				  	$totalSql Resultado(s) Obtenido(s)
			      </div>

			      <div class='table-responsive'>
			      	<table class='table table-hover'>
			      		<tr class='info'>
			      			<th colspan='2' class='text-center'>Nombre</th>
			      			<th class='text-center'># D.U.I</th>
			      			<th class='text-center'># Licencia</th>
			      			<th class='text-center'>Acción</th>
			      		</tr>";

      		
      		while ($row = $consulta->fetch()) {
      			$id = $row['id'];
      			$nombre = $row['nombres'];
      			$apellido = $row['apellidos'];
      			$dui = $row['dui'];
      			$licencia = $row['licencia'];

      			echo "<tr>
      			         <td class='text-center'>$nombre</td>
      			         <td class='text-center'>$apellido</td>
      			         <td class='text-center'>$dui</td>
      			         <td class='text-center'>$licencia</td>
      			         <td class='text-center'>
      			         	<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal'
      			         	        value='$id' id='btnReportClient' href='javascript:;'
      			         	        onclick='valorRptCli($(this).val()); return false;'>
  			         	        <span class='glyphicon glyphicon-eye-open'></span> Ver Reporte
      			         	</button>
      			         </td>
  			          </tr>";
      		}
			      	
			      	echo"
			      	</table>
			      </div>

			      <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel'>
			      	
			      </div>";


		}else{
			echo "<div class='alert alert-danger' role='alert'>
			      	No Se Han Encontrado Resultados Para $buscar
			      </div>";
		}

	}
?>

<script>
	function valorRptCli(btnReportClient){
		var valorRptClId = {
			"btnReportClient" : btnReportClient
		};

		$.ajax({
			type: "POST",
			url: "modalrptcli.php",
			data: valorRptClId,
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
	}
</script>