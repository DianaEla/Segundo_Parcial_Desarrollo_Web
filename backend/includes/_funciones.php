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
	

	$consulta = "SELECT * FROM usuarios WHERE correo_usr = '$correo'";
	$resultado = mysqli_query($mysqli, $consulta);
	$fila = mysqli_num_rows($resultado);
	if($fila == 0)
	{
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
}
?>