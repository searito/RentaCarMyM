<?php 
	require 'func/funciones.php';

	/*$conectar = new Conexion();
	$conectando = $conectar->Conectar();
	$mensaje = null;*/

	$conexion2 = new Conexion();
	$conexionando = $conexion2->ConexionAltenativa();

	#$connection = mysqli_connect('localhost', 'root', '', 'rentacar');

	/*if ($connection === false) {
		echo "Error <br> .mysqli_connect_error();";
	}else{
		echo "Conexion Exitosa";
	}*/

	$consultaBusqueda = $_POST['valorBusqueda'];

	// FILTO ANTI XSS
	$caracteresMalos = array("<", ">", "\"", "'", "/");
	$caracteresBuenos = array("&lt", "&gt", "&quot", "&#x27", "&#x2F", "&#060", "&#062", "&#039", "&#047");
	$consultaBusqueda = str_replace($caracteresMalos, $caracteresBuenos, $consultaBusqueda);

	$mensaje = "";

	if (isset($consultaBusqueda)) {
		$consulta = mysqli_query($connection, "SELECT * FROM clientes WHERE nombre LIKE '%$consultaBusqueda'");

		$filas = mysqli_num_rows($consulta);

		if ($filas === 0) {
			#$mensaje = echo "<script>alert('No Hay Coincidencia Alguna');</script>";
			$mensaje = "No Hay Coincidencia";
		}else{
			echo "<p>Resultados Obtenidos Para .$consultaBusqueda.</p>";

			while ($resultados = mysqli_fetch_array($consulta)) {
				$nombre = $resultados['nombre'];
				$dui = $resultados['dui'];
				$licencia = $resultados['licencia'];

				$mensaje .= "<p>Nombre: .$nombre. <br> D.U.I: .$dui.<br> Licencia: .$licencia.</p>";
			}

			echo $mensaje;
		}
	}
?>