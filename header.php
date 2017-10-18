<?php 

	require 'func/funciones.php';

	$conectar = new Conexion();
	$conectando = $conectar->Conectar();
	$mensaje = null;

	$sesion = new Sesion();
	$activa = $sesion->onSesion();
	$mensaje = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RentaCar M&M</title>

	<link rel="stylesheet" href="css/maquillaje.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.eot">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.svg">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.ttf">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff2">
	
	<link rel="stylesheet" href="ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
	<!--link rel="stylesheet" href="ui/css/custom-theme/jquery-ui-1.10.4.custom.min.css"-->

	<link rel="shotcut icon" href="img/ico-carro.png">

	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="css/js/bootstrap.js"></script>
	<script src="ui/js/jquery-ui-1.9.2.custom.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/additional-methods.js"></script>
	<script src="js/funcionesJava.js"></script>

	<style>
		.ui-progressbar .ui-progressbar-value { background-image: url(ui/development-bundle/demos/images/pbar-ani.gif); }
	</style>
	<!--script src="ui/js/jquery-ui-1.9.2.custom.min.js"></script-->

	 <!--link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css"-->
	 <!--script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script-->
	 <!--script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script-->    

</head>
<body>
	<section class="container">
		
	<h1 class="slavo upSpace titulo verde text-center">Rentacar M&M</h1>
	<h2 class="slavo subtitulo verde text-center">Sistema De Administración</h2>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4">
			<span class="label label-success">Ud. Está Logueado Como <?php echo $_SESSION['nombre']; ?>.</span>
		</div>
	</div><br>
		