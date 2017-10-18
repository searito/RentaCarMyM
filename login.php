<?php  
	include_once('func/funciones.php');

	$mensaje = null; 

	if (isset($_POST['login'])) {
		$model = new Logueo;
		$model->usuario = htmlspecialchars($_POST['usuario']);
		$model->password = md5(htmlspecialchars($_POST['password']));
		$model->Loguin();
		$mensaje = $model->mensaje;
	}

	session_start();

	if (empty($_SESSION['nombre'])) {
		session_destroy();
	}else{
		echo "<script>window.location=('index.php');</script>";
		}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>RentaCar M&M</title>

	<link rel="stylesheet" href="css/maquillaje.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/login.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.eot">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.svg">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.ttf">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff">
	<link rel="stylesheet" href="fonts/glyphicons-halflings-regular.woff2">
	
	<link rel="stylesheet" href="ui/css/custom-theme/jquery-ui-1.10.4.custom.css">
	

	<link rel="shotcut icon" href="img/ico-carro.png">

	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="css/js/bootstrap.js"></script>
	<script src="ui/js/jquery-ui-1.9.2.custom.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script src="js/additional-methods.js"></script>
	<script src="js/funcionesJava.js"></script>

</head>
<body>
	 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/profile.jpg">
            <p id="profile-name" class="profile-name-card"></p>

            <h3 class="verde text-center">Inicia Sesión</h3>

            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="usuario"class="form-control" placeholder="Usuario" required autofocus>
                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                <input type="hidden" name="login" value="">
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Acceder</button>
            </form>
        </div>
    </div>

</body>
</html>