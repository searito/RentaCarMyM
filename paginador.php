<?php
	$mysqli = new mysqli("localhost", "root", "", "rentacar");

	if($mysqli->connect_errno){
		echo "Fallo Al Conectar A (".$mysqli->connect_errno.")".$mysqli->connect_error;
	}
	echo $mysqli->host_info. "<br>";

	$querySelect = "SELECT * FROM autos";
	$queryExecute = $mysqli->query($querySelect);
	$total = $queryExecute->num_rows;

	$pageSize = 5;
	$pagina = $_GET['paginador'];

	if(!$pagina){
		$inicio = 0;
		$pagina = 1;
	}else{
		$inicio = ($pagina - 1) * $pageSize;
	}

	$totalPages = ceil($total / $pageSize);

	$consulta = "SELECT * FROM autos ORDER BY marca DESC LIMIT". $inicio. ",". $pageSize."";
	
	$contador = 1;
	while ($fila = $queryExecute->fetch_array()) {
		echo "Registro ".$contador++ ."<br>";
	}

	if ($totalPages > 1) {
		if ($pagina != 1) {
			echo '<a href="'.$url.'?pagina='.($pagina-1).'"><img src="img/6.gif" border="0"></a>';

			for ($i=1; $i <= $totalPages; $i++) { 
				if ($pagina == $i) {
					echo $pagina;
				}else{
					echo '<a href="'.$url.'?pagina='.$i.'">'.$i.'</a>';
				}

				if ($pagina != $totalPages) {
					echo '<a href="'.$url.'?pagina='.($pagina+1).'"><img src="img/6.gif" border="0"></a>';
				}
			}
		}
	}
?>