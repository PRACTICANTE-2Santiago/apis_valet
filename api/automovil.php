<?php
require_once 'headers.php';
$conn = new mysqli('localhost', 'root', '', 'valet_parking');

 
 if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset ($_GET['id'])) {
        $id = $conn->real_escape_string($_GET['id']);
        $sql = $conn->query("SELECT * FROM automovil where id = '$id' ");
        $data = $sql->fetch_assoc(); 
    }else {
    $data =array();
    $sql = $conn->query("SELECT * FROM  automovil");
    while($d = $sql->fetch_assoc()) {
        $data[] = $d;
       
    }
  
}
exit (json_encode($data)); 
}

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents("php://input"));
  $sql = $conn->query("INSERT INTO automovil (
     id,
      id_valet
      , placas
      , descripcion
      , foto1
      , foto2
      , foto3
      , id_registro
      , fecha_registro
       , id_ubicacion
       , latitud
       , longitud
       , comentarios
       , fecha_ubicacion
       , fecha_pedir
       , id_entrega
       , fecha_entregado
       , comentarios_entregado
       , fecha_notificado
       , comentarios_cliente
       , token
       , condiciones
       , estatus)
  VALUES('".$data->id."',
  '".$data->id_valet."',
  '".$data->placas."',
  '".$data->descripcion."',
  '".$data->foto1."',
  '".$data->foto2."',
  '".$data->foto3."',
  '".$data->id_registro."',
  '".$data->fecha_registro."',
  '".$data->id_ubicacion."',
  '".$data->latitud."',
  '".$data->longitud."',
  '".$data->comentarios."',
  '".$data->fecha_ubicacion."',
  '".$data->fecha_pedir."',
  '".$data->id_entrega."',
  '".$data->fecha_entregado."',
  '".$data->comentarios_entregado."',
  '".$data->fecha_notificado."',
  '".$data->comentarios_cliente."',
  '".$data->token."',
  '".$data->condiciones."',
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
        $sql = $conn->query("UPDATE automovil SET  
         id_valet = '".$data->id_valet."'
         , placas = '".$data->placas."'
         , descripcion = '".$data->descripcion."'
         , foto1 = '".$data->foto1."'
        , foto2 = '".$data->foto2."'
        ,  foto3 = '".$data->foto3."'
        , id_registro = '".$data->id_registro."'
        , fecha_registro  = '".$data->fecha_registro."'
        , id_ubicacion = '".$data->id_ubicacion."'
        , latitud = '".$data->latitud."'
        , longitud = '".$data->longitud."'
        , comentarios = '".$data->comentarios."'
        , fecha_ubicacion = '".$data->fecha_ubicacion."'
        , fecha_pedir = '".$data->fecha_pedir."'
        ,   id_entrega = '".$data->id_entrega."'
        , fecha_entregado = '".$data->fecha_entregado."'
        , comentarios_entregado = '".$data->comentarios_entregado."'
        , fecha_notificado = '".$data->fecha_notificado."'
        , comentarios_cliente = '".$data->comentarios_cliente."'
        , token = '".$data->token."'
        , condiciones = '".$data->condiciones."'
        , estatus = '".$data->estatus."'
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
        $sql = $conn->query("UPDATE automovil SET  
         id_valet = '".$data->id_valet."'
         , placas = '".$data->placas."'
         , descripcion = '".$data->descripcion."'
         , foto1 = '".$data->foto1."'
        , foto2 = '".$data->foto2."'
        ,  foto3 = '".$data->foto3."'
        , id_registro = '".$data->id_registro."'
        , fecha_registro  = '".$data->fecha_registro."'
        , id_ubicacion = '".$data->id_ubicacion."'
        , latitud = '".$data->latitud."'
        , longitud = '".$data->longitud."'
        , comentarios = '".$data->comentarios."'
        , fecha_ubicacion = '".$data->fecha_ubicacion."'
        , fecha_pedir = '".$data->fecha_pedir."'
        ,   id_entrega = '".$data->id_entrega."'
        , fecha_entregado = '".$data->fecha_entregado."'
        , comentarios_entregado = '".$data->comentarios_entregado."'
        , fecha_notificado = '".$data->fecha_notificado."'
        , comentarios_cliente = '".$data->comentarios_cliente."'
        , token = '".$data->token."'
        , condiciones = '".$data->condiciones."'
        , estatus = '".$data->estatus."'
         WHERE id = '$id'");
        if ($sql){
            exit(json_encode(array('status' => 'eliminado')));
        }else{
            exit(json_encode(array('status' => 'error'))); 
        }
        }
    
}
?>
