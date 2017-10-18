<?php  
	
	class Conexion{

		public function Conectar(){
			$usuario = 'root';
			$password = '';
			$host = 'localhost';
			$db = 'rentacar';

			return $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
		}
	}


	class CRUD{

		public $insertInto;
		public $insertColumns;
		public $insertValues;
		public $mensaje;

		public $select;
		public $from;
		public $condition;
		public $rows;

		public $update;
		public $set;

		public $deleteFrom;


		public function Create(){
			$model = new Conexion();
			$conexion = $model->Conectar();
			$insertInto = $this->insertInto;
			$insertColumns = $this->insertColumns;
			$insertValues = $this->insertValues;
			$sql = "INSERT INTO $insertInto ($insertColumns) VALUES ($insertValues)";
			$consulta = $conexion->prepare($sql);

			if (!$consulta) {
				
			}else{
				$consulta->execute();
				$this->mensaje = "";
			}
		}


		public function Read(){
			$model = new Conexion();
			$conexion = $model->Conectar();
			$select = $this->select;
			$from = $this->from;
			$condition = $this->condition;

			if ($condition != '') {
				$condition = " WHERE ". $condition;
			}

			$sql = "SELECT $select FROM $from $condition";
			$consulta = $conexion->prepare($sql);
			$consulta->execute();

			while ($filas = $consulta->fetch()) {
				$this->rows[] = $filas;
			}
		}


		public function Update(){
			$model = new Conexion();
			$conexion = $model->Conectar();
			$update = $this->update;
			$set = $this->set;
			$condition = $this->condition;

			if ($condition != "") {
				$condition = " WHERE ". $condition;
			}

			$sql = ("UPDATE $update SET $set $condition");
			$consulta = $conexion->prepare($sql);

			if (!$consulta) {
			
			}else{
				$consulta->execute();
				$this->mensaje = "";
			}
		}


		public function Delete(){
			$model = new Conexion();
			$conexion = $model->Conectar();
			$deleteFrom = $this->deleteFrom;
			$set = $this->set;
			$condition = $this->condition;

			if ($condition != "") {
				$condition = " WHERE ". $condition;
			}

			if (!$consulta) {
				$this->mensaje = " ";
			}else{
				$consulta->execute();
				$this->mensaje = "";
			}		
		}
	}


	class Logueo{
		public $usuario;
		public $password;
		public $mensaje;

		public function Loguin(){
			$model = new Conexion;
			$conexion = $model->Conectar();
			$sql = ("SELECT * FROM usuarios WHERE ");
			$sql .= "usuario=:usuario AND pass=:password";
			$consulta = $conexion->prepare($sql);
			$consulta->bindParam(':usuario', $this->usuario, PDO::PARAM_STR);
			$consulta->bindParam(':password', $this->password, PDO::PARAM_STR);
			$consulta->execute();
			$total = $consulta->rowCount();

			if ($total == 0) {
				$this->mensaje = "";
				echo "<script>alert('Error Al Iniciar Sesión, Datos Incorrectos.');</script>";
			}else{
				$fila = $consulta->fetch();
				session_start();

				$_SESSION['login'] = true;
				$_SESSION['id'] = $fila['id'];
				$_SESSION['nombre'] = $fila['usuario'];
				header('location: index.php');
			}
		}
	}

	class Sesion{
		public function onSesion(){

		session_start();

		if ($_SESSION['nombre'] == true) {
			
		}else{
			session_unset();
			session_destroy();
			header('location:login.php');
		}
	}
}

?>