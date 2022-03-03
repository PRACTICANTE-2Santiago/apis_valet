<?php
require_once 'headers.php';
$conn = new mysqli('localhost', 'root', '', 'valet_parking');

 
 if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset ($_GET['id'])) {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = $conn->query("SELECT * FROM comercios where id = '$id' ");
        $data = $sql->fetch_assoc(); 
    }else {
    $data =array();
    $sql = $conn->query("SELECT * FROM  comercios");
    while($d = $sql->fetch_assoc()) {
        $data[] = $d;
       
    }
  
}
exit (json_encode($data)); 
}

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));
  $sql = $conn->query("INSERT INTO comercios (
    id,
    id_valet,
    id_creditos, 
    nombre,
    calle,
    codigo_postal,
    telefono,
    correo_electronico,
    logotipo, 
    representante,
    tarifa, 
    estatus) 
  VALUES('".$data->id."',
  '".$data->id_valet."',
  '".$data->id_creditos."',
  '".$data->nombre."',
  '".$data->calle."',
  '".$data->codigo_postal."',
  '".$data->telefono."',
  '".$data->correo_electronico."',
  '".$data->logotipo."',
  '".$data->representante."',
  '".$data->tarifa."',
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
        $sql = $conn->query("UPDATE comercios SET 
        id =  '".$data->id."'
        ,id_valet = '".$data->id_valet."'
        ,id_creditos = '".$data->id_creditos."'
        , nombre = '".$data->nombre."'
        , calle = '".$data->calle."'
        , codigo_postal = '".$data->codigo_postal."'
        , telefono = '".$data->telefono."'
        ,  correo_electronico = '".$data->correo_electronico."'
        , logotipo = '".$data->logotipo."'
        , representante  = '".$data->representante."'
        , tarifa  = '".$data->tarifa."'
        , estatus = '".$data->estatus."' WHERE id = '$id'");
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
        $sql = $conn->query("UPDATE comercios SET  
         id =  '".$data->id."'
        ,id_valet = '".$data->id_valet."'
        ,id_creditos = '".$data->id_creditos."'
        , nombre = '".$data->nombre."'
        , calle = '".$data->calle."'
        , codigo_postal = '".$data->codigo_postal."'
        , telefono = '".$data->telefono."'
        ,  correo_electronico = '".$data->correo_electronico."'
        , logotipo = '".$data->logotipo."'
        , representante  = '".$data->representante."'
        , tarifa  = '".$data->tarifa."'
        , estatus = '".$data->estatus."' WHERE id = '$id'");
        if ($sql){
            exit(json_encode(array('status' => 'success')));
        }else{
            exit(json_encode(array('status' => 'error'))); 
        }
        }
    
}
?>
