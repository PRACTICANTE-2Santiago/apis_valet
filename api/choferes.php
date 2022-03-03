<?php
require_once 'headers.php';
$conn = new mysqli('localhost', 'root', '', 'valet_parking');

 
 if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset ($_GET['id'])) {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = $conn->query("SELECT * FROM choferes where id = '$id' ");
        $data = $sql->fetch_assoc(); 
    }else {
    $data =array();
    $sql = $conn->query("SELECT * FROM  choferes");
    while($d = $sql->fetch_assoc()) {
        $data[] = $d;
       
    }
  
}
exit (json_encode($data)); 
}

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));
  $sql = $conn->query("INSERT INTO choferes (
    id,
    id_valet ,
    usuario,
    contrasenia,
    nombre,
    apellido_paterno,
    apellido_materno,
    ine, 
    licencia, 
    telefono,
    correo_electronico,
    fecha_registro, 
    token,
    estatus)
  VALUES(
      '".$data->id."',
      '".$data->id_valet."',
      '".$data->usuario."',
      '".$data->contrasenia."',
      '".$data->nombre."',
      '".$data->apellido_paterno."',
      '".$data->apellido_materno."',
      '".$data->ine."',
      '".$data->licencia."',
      '".$data->telefono."',
      '".$data->correo_electronico."',
      '".$data->fecha_registro."',
      '".$data->token."',
      '".$data->estatus."')");
  if($sql){
      $data->id = $conn->insert_id;
      exit(json_encode($data));
  }

}
if($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if(isset($_GET['id'])){
        $id = $conn->real_escape_string($_GET['id']);
        $data = json_decode(file_get_contents("php://input"));
        $sql = $conn->query("UPDATE choferes SET 
            id = '".$data->id."',
           id_valet = '".$data->id_valet."',
           usuario = '".$data->usuario."',
           contrasenia = '".$data->contrasenia."',
           nombre = '".$data->nombre."',
           apellido_paterno = '".$data->apellido_paterno."',  
           apellido_materno = '".$data->apellido_materno."',  
           ine = '".$data->ine."', 
           licencia = '".$data->licencia."', 
           telefono = '".$data->telefono."', 
           correo_electronico = '".$data->correo_electronico."', 
           fecha_registro = '".$data->fecha_registro."', 
           token  = '".$data->token."',
           estatus = '".$data->estatus."' WHERE id = '$id'");
        if ($sql){
            exit(json_encode(array('status' => 'success')));
        }else{
            exit(json_encode(array('status' => 'error'))); 
        }
        }
    
}
if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $conn->real_escape_string($_GET['id']);
        $data = json_decode(file_get_contents("php://input"));
        $sql = $conn->query("UPDATE choferes SET 
          id_valet = '".$data->id_valet."',
           usuario = '".$data->usuario."',
           contrasenia = '".$data->contrasenia."',
           nombre = '".$data->nombre."',
           apellido_paterno = '".$data->apellido_paterno."',  
           apellido_materno = '".$data->apellido_materno."',  
           ine = '".$data->ine."', 
           licencia = '".$data->licencia."', 
           telefono = '".$data->telefono."', 
           correo_electronico = '".$data->correo_electronico."', 
           fecha_registro = '".$data->fecha_registro."', 
           token  = '".$data->token."',
           estatus = '".$data->estatus."' WHERE id = '$id'");
        if ($sql){
            exit(json_encode(array('status' => 'eliminado')));
        }else{
            exit(json_encode(array('status' => 'error'))); 
        }
        }
    
}
?>
