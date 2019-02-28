<?php
require_once '_db.php';
switch ($_POST["accion"]) {
  case "login":
    login();
    break;
  case "consultar_usuarios":
  consultar_usuarios();
  break;

  break;
  case "insertar_usuarios":
  insertar_usuarios();

  break;
  case "consultar_team":
  consultar_team();

  break;
  case "insertar_team":
  insertar_team();

  break;
  case "eliminar_registro":
  eliminar_usuarios($_POST["registro"]);

  break; 
  case 'editar_registro':
    editar_usuarios($registro= $_POST["registro"]);
     

  break;

  default:
    # code...
    break;
}
    function consultar_usuarios(){
  global $mysqli;
  $consulta = "SELECT * FROM usuarios";
  $resultado = mysqli_query($mysqli, $consulta);
  $arreglo = [];
  while($fila = mysqli_fetch_array($resultado)){
    array_push($arreglo, $fila);
  }
  echo json_encode($arreglo); //Imprime el JSON ENCODEADO

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
  $fila = $resultado->fetch_assoc();
  if($fila == 0)
  {
    echo "El usuario no exite [ERROR]";
    }
    //Si el usuario existe, consultar que el password sea correcto
    else if ($fila["pswd_usr"] != $password)
    {
      $consulta = "SELECT *FROM usuarios WHERE correo_usr = '$correo' AND pswd_usr = '$password'";
      $resultado = mysqli_query($mysqli, $consulta);
      $fila = $resultado->fetch_assoc();
      //Si el password no es correcto, imprimir 0
      echo "El password es incorrecto [ERROR]";
    } 
    
    else if($correo == $fila["correo_usr"] && $password == $fila["pswd_usr"])
    {
      //Si el password es correcto, imprimir 1
      echo "El usuario y password son correctos [ACESSO]";
    }
}
   function insertar_usuarios(){
      $nombre= $_POST["nombre"];
      $correo= $_POST["correo"];
      $contraseña= $_POST["contraseña"];
      $telefono= $_POST["telefono"];

    global $mysqli;
    $consulta = "INSERT INTO usuarios VALUES('','$nombre','$correo','$contraseña', '$telefono', '1')";
    $result = $mysqli->query($consulta);
    $num_rows = $result->num_rows;
    if ($num_rows > 0){
    echo "1";
    } else {
    echo"0";
      }
    }

    function consultar_team(){
  global $mysqli;
  $consulta = "SELECT * FROM team";
  $resultado = mysqli_query($mysqli, $consulta);
  $arreglo = [];
  while($fila = mysqli_fetch_array($resultado)){
    array_push($arreglo, $fila);
  }
  echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}
function insertar_team(){
  global $mysqli;
  $team_img = $_POST["imagen"];
  $team_name = $_POST["nombre"]; 
  $team_position = $_POST["cargo"];
  $team_description = $_POST["descripcion"];
  $consulta = "INSERT INTO team VALUES('','$team_img','$team_name','$team_position','$team_description')";
  $resultado = mysqli_query($mysqli, $consulta);
  $arreglo = [];
  while($fila = mysqli_fetch_array($resultado)){
    array_push($arreglo, $fila);
  }
  echo json_encode($arreglo); //Imprime el JSON ENCODEADO
}



function eliminar_usuarios($id){
  global $mysqli;
  $query = "DELETE FROM usuarios WHERE id_usr = $id";
  $resultado = mysqli_query($mysqli, $query);
  if ($resultado) {
    echo "Se eliminó correctamente";
  } else {
    echo "Se generó un error, intenta nuevamente";
  }
}





    

?>