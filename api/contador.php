<?php

    require_once 'headers.php';
    
    $conn = new mysqli('localhost', 'root', '', 'valet_parking');

    //mysqli_query($conn, 'SET NAMES 'utf8'');


    //Metogo GET
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $sql = $conn->query("SELECT * FROM contador where id = '$id' ");
            $data = $sql->fetch_assoc();
        }
        else{
            $data = array();
            $sql = $conn-> query("SELECT * FROM contador");
            while ($d = $sql->fetch_assoc()) {
                $data[] = $d;
            }
        }

        exit(json_encode($data));
    }


    //Metodo POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents("php://input"));
        $sql = $conn->query("INSERT INTO cpntador (id, 
                id_valet, 
                id_creditos, 
                fecha_registro, 
                total, 
                stock, 
                estatus) 
            VALUES ('".$data->id."',
                '".$data->id_valet."',
                '".$data->id_creditos."',
                '".$data->fecha_registro."',
                '".$data->total."',
                '".$data->stock."',
                '".$data->estatus."')");
        if ($sql) {
            $data->id = $conn->insert_id;
            exit(json_encode($data));
        }else{
            exit(json_encode(array('status' => 'error')));
        }
    }


    //Metodo PUT
    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $data = json_decode(file_get_contents("php://input"));
            $sql = $conn->query("UPDATE contador SET 
                id = '".$data->id."', 
                id_valet = '".$data->id_valet."', 
                id_creditos = '".$data->id_creditos."', 
                fecha_registro = '".$data->fecha_registro."', 
                total = '".$data->total."', 
                stock = '".$data->stock."', 
                estatus = '".$data->estatus."' 
            WHERE id = '$id'");
            if ($sql) {
                exit(json_encode(array('status' => 'success')));
            } else{
                exit(json_encode(array('status' => 'error')));
            }
        }
    }


    //Metodo DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (isset($_GET['id'])) {
            $id = $conn->real_escape_string($_GET['id']);
            $data = json_decode(file_get_contents("php://input"));
            $sql = $conn->query("UPDATE contador SET 
                id = '".$data->id."', 
                id_valet = '".$data->id_valet."', 
                id_creditos = '".$data->id_creditos."', 
                fecha_registro = '".$data->fecha_registro."', 
                total = '".$data->total."', 
                stock = '".$data->stock."', 
                estatus = '".$data->estatus."' 
            WHERE id = '$id'");
            if ($sql) {
                exit(json_encode(array('status' => 'eliminado')));
            } else{
                exit(json_encode(array('status' => 'error')));
            }
        }
    }



