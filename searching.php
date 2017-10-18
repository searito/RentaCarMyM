<?php  

	$buscar = $_POST['b'];

	if (!empty($buscar)) {
		Buscar($buscar);
	}

	function Buscar($b){
		$con = mysql_connect('localhost','root', '');
		mysql_select_db('rentacar', $con);

		$sql = mysql_query("SELECT clientes.id AS 'id', clientes.nombres AS 'nombre', clientes.apellidos AS 'apellido', 
								   clientes.dui AS 'dui', clientes.licencia AS 'licencia', clientes.tcel AS 'celular'
							FROM clientes
							WHERE nombres LIKE '%".$b."%' OR dui LIKE '%".$b."%' OR apellidos LIKE '%".$b."%' ORDER BY clientes.apellidos ASC LIMIT 10");

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
		    	  			<th>Apellidos</th>
		    	  			<th>Nombres</th>
			    	  		<th>D.U.I.</th>
			    	  		<th>Licencia</th>
			    	  		<th>Teléfono Celular</th>
			    	  		<th>Acción</th>
		    	  		</tr>";

  			while ($row = mysql_fetch_assoc($sql)) {
  				$id = $row['id'];
  				$apellidos = $row['apellido'];
  				$nombre = $row['nombre'];
				$dui = $row['dui'];
				$licencia = $row['licencia'];
				$tcel = $row['celular'];
  				
				echo"
  				<tr>
					<td>".$apellidos."</td>
  					<td>".$nombre."</td>
  					<td>".$dui."</td>
  					<td>".$licencia."</td>
  					<td>".$tcel."</td>
  					<td>
  						<a href='modificar-cliente.php?id=".$id."' class='btn btn-primary'>
  						<span class='glyphicon glyphicon-refresh'></span> Modificar</a>

  						<a href='alquilandoc.php?id=".$id."' class='btn btn-success'>
  						<span class='glyphicon glyphicon-share'></span> Alquilar</a>
					</td>
  				</tr>";
  			
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
