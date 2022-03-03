<?php
require_once 'headers.php';
$conn = new mysqli('localhost', 'root', '', 'valet_parking');

 
 if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset ($_GET['id'])) {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = $conn->query("SELECT * FROM chofer_lugares where id = '$id' ");
        $data = $sql->fetch_assoc(); 
    }else {
    $data =array();
    $sql = $conn->query("SELECT * FROM  chofer_lugares");
    while($d = $sql->fetch_assoc()) {
        $data[] = $d;
       
    }
  
}
exit (json_encode($data)); 
}

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));
  $sql = $conn->query("INSERT INTO chofer_lugares (
      id,
      id_comercios,
      id_chofer, 
      fecha_registro,
      estatus)
  VALUES(
      '".$data->id."',
      '".$data->id_comercios."',
      '".$data->id_chofer."',
      '".$data->fecha_registro."',
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
        $sql = $conn->query("UPDATE chofer_lugares SET 
          id_comercios = '".$data->id_comercios."', 
          id_chofer = '".$data->id_chofer."',
          fecha_registro = '".$data->fecha_registro."', 
          estatus = '".$data->estatus."'
         WHERE id = '$id'");
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
        $sql = $conn->query("UPDATE chofer_lugares SET 
          id_comercios = '".$data->id_comercios."', 
          id_chofer = '".$data->id_chofer."',
          fecha_registro = '".$data->fecha_registro."', 
          estatus = '".$data->estatus."'
         WHERE id = '$id'");
        if ($sql){
            exit(json_encode(array('status' => 'eliminado')));
        }else{
            exit(json_encode(array('status' => 'error'))); 
        }
        }
    
}
?>
