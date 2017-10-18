<?php 
	require('func/funciones.php');

	if (isset($_GET['term'])) {
		$arrayRetorno = array();

		try{
			$conectar = new Conexion();
			$conectando = $conectar->Conectar();

			$estado = $conectando->prepare("SELECT * FROM autos WHERE placa LIKE :term OR marca LIKE :term OR modelo LIKE :term");
			$estado->execute(array('term' => '%'.$_GET['term'].'%'));

			while ($fila = $estado->fetch()) {
				$arrayRetorno[] = $fila['marca']." ". $fila['modelo']." -- ". $fila['placa'];
			}
		}catch(PDOException $e){
			echo "Error: ". $e->get_message();
		}

		echo json_encode($arrayRetorno);
	}
?>