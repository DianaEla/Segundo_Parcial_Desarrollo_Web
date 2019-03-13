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
  case "eliminar_team":
  eliminar_team($_POST["id"]);

  break; 
  case 'editar_registro':
    editar_usuarios($registro= $_POST["id"]);

  break; 
  case 'editar_team':
    editar_team($registro= $_POST["id"]);

    break; 
  case 'consultar_miembro':
    consultar_miembro($registro= $_POST["id"]);
  

break;
    //**CARGA FOTO**//
  case 'carga_foto':
  carga_foto();
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
    // Conectar a la base de datos
  global $mysqli;
    // Si usuario y contraseña están vacíos imprimir 3
  $correo = $_POST['correo']; 
  $password = $_POST['password'];
  $consulta = "SELECT * FROM usuarios WHERE correo_usr ='$correo'";
  $resultado = mysqli_query($mysqli, $consulta);
  $fila = mysqli_fetch_array($resultado);
  if($fila["pswd_usr"] == "$password" ){
    
    session_start();
        error_reporting(0);
        $_SESSION['usuario'] = $correo;
  
        echo "1"; 
      }
    else 
      {
        echo "Error en la contraseña o usuario";
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

    function consultar_miembro($id){
  global $mysqli;
  $consulta = "SELECT * FROM team WHERE team_id = $id";
  $resultado = mysqli_query($mysqli, $consulta);
  $fila = mysqli_fetch_array($resultado);
  echo json_encode($fila); //Imprime el JSON ENCODEADO
}

function insertar_team(){
  global $mysqli;
  $team_img = $_POST["imagen"];
  $team_name = $_POST["nombre"]; 
  $team_position = $_POST["cargo"];
  $team_description = $_POST["descripcion"];
  $consulta = "INSERT INTO team VALUES('','$team_img','$team_name','$team_position','$team_description')";
  $resultado = mysqli_query($mysqli, $consulta);
    if ($resultado) {
    echo "Se agrego correctamente";
  } else {
    echo "Se generó un error, intenta nuevamente";
  }

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

function editar_team($id){
  global $mysqli;
  extract($_POST);
  $consulta = "UPDATE team SET team_img = '$imagen', team_name = '$nombre', 
  team_position = '$cargo', team_description = '$descripcion' WHERE team_id = '$id' ";
  $resultado = mysqli_query($mysqli, $consulta);
  if($resultado){
    echo "Se editó correctamente";
  }else{
    echo "Se generó un error, intentalo nuevamente";
  }
}



function eliminar_team($id){
  global $mysqli;
  $query = "DELETE FROM team WHERE team_id = $id";
  $resultado = mysqli_query($mysqli, $query);
  if ($resultado) {
    echo "Se eliminó correctamente";
  } else {
    echo "Se generó un error, intenta nuevamente";
  }
}




function carga_foto(){
  if (isset($_FILES["foto"])) {
    $file = $_FILES["foto"];
    $nombre = $_FILES["foto"]["name"];
    $temporal = $_FILES["foto"]["tmp_name"];
    $tipo = $_FILES["foto"]["type"];
    $tam = $_FILES["foto"]["size"];
    $dir = "../../img/insertadas/";
    $respuesta = [
      "archivo" => "../img/insertadas/error.jpg",
      "status" => 0
    ];
    if(move_uploaded_file($temporal, $dir.$nombre)){
      $respuesta["archivo"] = "../img/insertadas/".$nombre;
      $respuesta["status"] = 1;
    }
    echo json_encode($respuesta);
  }
}




    
?>