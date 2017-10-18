<?php
	$buscar = $_POST['b'];

	if (!empty($buscar)) {
		Buscar($buscar);
	}

	function Buscar($b){
		$con = mysql_connect('localhost','root', '');
		mysql_select_db('rentacar', $con);
		
		$sql = mysql_query("SELECT * FROM autos
							WHERE placa LIKE '%".$b."%' OR marca LIKE '%".$b."%' OR modelo LIKE '%".$b."%' OR usd LIKE '%".$b."%' LIMIT 10");

		if ($sql === false) {
			die(mysql_error());
		}

		if (mysql_num_rows($sql)!=0) {
			echo "<div class='alert alert-success' role='alert'>
					".mysql_num_rows($sql)." Coincidencias
				  </div>";

		    echo "<div class='table-responsive'>
		    	  	<table class='table table-hover'>
		    	  		<tr class='success'>
		    	  			<th>Marca</th>
			    	  		<th>Modelo</th>
			    	  		<th>Color</th>
			    	  		<th>Matrícula</th>
			    	  		<th>Precio</th>
			    	  		<th class='centro'>Acción</th>
		    	  		</tr>";

  			while ($row = mysql_fetch_assoc($sql)) {
  				$id = $row['id'];
  				$marca = $row['marca'];
				$modelo = $row['modelo'];
				$color = $row['color'];
				$placa = $row['placa'];
  				$precio = $row['usd'];
  				$estado = $row['disponible'];

  				switch ($estado) {
  					case 0:
  						echo"
			  				<tr>
			  					<td>".$marca."</td>
			  					<td>".$modelo."</td>
			  					<td>".$color."</td>
			  					<td>".$placa."</td>
			  					<td> $".$precio."</td>
			  					<td class='centro'>
			  						<a href='updating-auto.php?id=".$id."' class='btn btn-primary'>
			  						<span class='glyphicon glyphicon-refresh'></span> Modificar</a>

			  						<button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span> Alquilado</a> </button>
								</td>
			  				</tr>";
  						break;
  					
  					case 1:
  						echo"
			  				<tr>
			  					<td>".$marca."</td>
			  					<td>".$modelo."</td>
			  					<td>".$color."</td>
			  					<td>".$placa."</td>
			  					<td> $".$precio."</td>
			  					<td class='centro'>
			  						<a href='updating-auto.php?id=".$id."' class='btn btn-primary'>
			  						<span class='glyphicon glyphicon-refresh'></span> Modificar</a>

			  						<a href='alquiloc.php?id=".$id."' class='btn btn-success'>
  									<span class='glyphicon glyphicon-share'></span> Alquilar</a>
								</td>
			  				</tr>";
  						break;


  					case 2:
  						echo"
			  				<tr>
			  					<td>".$marca."</td>
			  					<td>".$modelo."</td>
			  					<td>".$color."</td>
			  					<td>".$placa."</td>
			  					<td> $".$precio."</td>
			  					<td class='centro'>
			  						<a href='updating-auto.php?id=".$id."' class='btn btn-primary'>
			  						<span class='glyphicon glyphicon-refresh'></span> Modificar</a>

			  						<button type='button' class='btn btn-info'><span class='glyphicon glyphicon-wrench'></span> En Taller</button>
								</td>
			  				</tr>";
  						break;
  				}
  			
  			}
		    	  	echo"
		    	  	</table>	
		    	  </div>";
		}else{
			echo "<div class='alert alert-danger' role='alert'>
				   	No se han encontrado resultados para '<b>".$b."</b>'.
				  </div>";
		}              

	}

?>
