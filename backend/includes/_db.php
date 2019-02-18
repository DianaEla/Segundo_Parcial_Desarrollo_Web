<?php 
$correo = "smoothoperators.com.mx";
$database = "smoothop_segundo_parcial";
$usuario = "smoothop_db";
$password = "Goodluck13";

$mysqli = new mysqli($correo, $usuario, $password, $database);
if ($mysqli->connect_errno) {
	echo "Lo sentimos, este sitio web está experimentando problemas.";
	echo "Error: Fallo al conectarse a MySQL debido a: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}
?>