<?php 
	require 'func/funciones.php';

	if (isset($_GET['term'])) {
		$retrurnArr = array();

		try{
			
			$conectar = new Conexion();
			$conectando = $conectar->Conectar();

			$stmt = $conectando->prepare("SELECT * FROM clientes WHERE nombres LIKE :term OR apellidos LIKE :term OR dui LIKE :term");
			$stmt->execute(array('term' => '%'.$_GET['term'].'%'));

			while ($row = $stmt->fetch()) {
				$retrurnArr[] = $row['nombres']." ".
								$row['apellidos']." - ".
								$row['dui'];
			}

		}catch(PDOException $e){
			echo "Error:". $e->get_message();
		}

		echo json_encode($retrurnArr);
	}
?>
