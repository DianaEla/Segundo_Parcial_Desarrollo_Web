<?php
require_once '_db.php';
switch ($_POST["accion"]) {
	case "login":
		login();
		break;
	
	default:
		# code...
		break;
		//-------------------------------------------------------------------------------
}
function login(){


	//Conectar con la base de datos
	global $mysqli;
	$correo= $_POST["usuario"];
	$password = $_POST["password"];
	//echo "Tu usuario es: ".$_POST["usuario"]." y tu password es: ".$_POST["password"];
	//Conectar con la base de datos
	

	$consulta = "SELECT * FROM usuario WHERE correo_usr = '$correo'";
	$resultado = mysqli_query($mysqli, $consulta);
	$fila = mysqli_num_rows($resultado);
	if($fila == 0)
	{

		//Si el usuario no existe, imprimir 0
		echo "El usuario no exite [ERROR]";
		}

		//Si el usuario existe, consultar que el password sea correcto
		else if ($fila["password"] != $password)
		{
			$consulta = "SELECT *FROM usuario WHERE correo_usr = '$correo' AND password = '$password'";
			$resultado = $mysqli->query($consulta);
			$fila = $resultado->fetch_assoc();
			//Si el password no es correcto, imprimir 0
			echo "El password es incorrecto [ERROR]";
		}	
		
		else if($correo == $fila["correo_usr"] && $password == $fila["password"])
		{
			//Si el password es correcto, imprimir 1
			echo "El usuario y password son correctos [ACESSO]";
		}


	//echo "Tu usuario es: ".$_POST["usuario"]." y tu password es: ".$_POST["password"];
	//Conectar con la base de datos
	global $mysqli;
	$usu = $_POST["usuario"];
	$pass = $_POST["password"];
	$num = 0;

	//Si usuario y contraseña están vacíos que imprima 3
	if ($usu==''||$pass=='') {
		$num = 3;
	} else {
		$query = "SELECT * FROM usuarios WHERE correo_usr = '$usu'";
		$result = $mysqli->query($query);
		if ($result->num_rows == 0) {
			$num = 2;
		} else {
			$query2 = "SELECT * FROM usuarios WHERE correo_usr = '$usu' AND pswd_usr = '$pass'";
			$result2 = $mysqli->query($query2);
			if ($result2->num_rows > 0) {
				$num = 1;
			} elseif ($result2->num_rows == 0) {
				$num = 0;
			}
		}
	}
	imprimir($num);
	//Consultar a la base de datos que el usuario exista

	//Si el usuario existe, consultar que el password sea correcto
	//Si el password es correcto, imprimir 1
	//Si el password no es correcto, imprimir 0
	//Si el usuario no existe, imprimir 2
}
function imprimir($n){
	switch ($n) {
		case 0:
			echo "Contraseña incorrecta - 0";
			break;
		case 1:
			echo "Acceso permitido - 1";
			break;
		case 2:
			echo "El usuario no existe - 2";
			break;
		case 3:
			echo "Favor de llenar los campos - 3";
			break;
		default:
			# code...
			break;
	}

}
?>