<?php  

	require_once 'headers.php';

	$conn = new mysqli('localhost', 'root', '', 'valet_parking');


	//Metodo GET
	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['id'])) {
			$id = $conn->real_escape_string($_GET['id']);
			$sql = $conn->query("SELECT * FROM usuarios WHERE id = '$id'");
			$data = $sql->fetch_assoc();
		}
		else{
			$data = array();
			$sql = $conn->query("SELECT * FROM usuarios");
			while ($d = $sql->fetch_assoc()){
				$data[] = $d;
			}
		}
		exit(json_encode($data));
	}

	//Metodo POST
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$data = json_decode(file_get_contents("php://input"));
		$sql = $conn->query("INSERT INTO usuarios (id, 
			id_valet, 
			usuario, 
			contrasena, 
			nombre, 
			apellido_paterno, 
			apellido_materno, 
			calle, 
			num_ext, 
			num_int, 
			colonia, 
			municipio, 
			estado, 
			pais, 
			codigo_postal, 
			telefono, 
			correo_electronico, 
			fecha_registro, 
			estatus) 
		VALUES ('".$data->id."',
			'".$data->id_valet."',
			'".$data->usuario."',
			'".$data->contrasena."',
			'".$data->nombre."',
			'".$data->apellido_paterno."',
			'".$data->apellido_materno."',
			'".$data->calle."',
			'".$data->num_ext."',
			'".$data->num_int."',
			'".$data->colonia."',
			'".$data->municipio."',
			'".$data->estado."',
			'".$data->pais."',
			'".$data->codigo_postal."',
			'".$data->telefono."',
			'".$data->correo_electronico."',
			'".$data->fecha_registro."',
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
			$sql = $conn->query("UPDATE usuarios SET 
				id = '".$data->id."', 
				id_valet = '".$data->id_valet."', 
				usuario = '".$data->usuario."', 
				contrasena = '".$data->contrasena."', 
				nombre = '".$data->nombre."', 
				apellido_paterno = '".$data->apellido_paterno."', 
				apellido_materno = '".$data->apellido_materno."', 
				calle = '".$data->calle."', 
				num_ext = '".$data->num_ext."', 
				num_int = '".$data->num_int."',
				colonia = '".$data->colonia."', 
				municipio = '".$data->municipio."',
				estado = '".$data->estado."',
				pais = '".$data->pais."',
				codigo_postal = '".$data->codigo_postal."',
				telefono = '".$data->telefono."',
				correo_electronico = '".$data->correo_electronico."',
				fecha_registro = '".$data->fecha_registro."',
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
			$sql = $conn->query("UPDATE usuarios SET 
				id = '".$data->id."', 
				id_valet = '".$data->id_valet."', 
				usuario = '".$data->usuario."', 
				contrasena = '".$data->contrasena."', 
				nombre = '".$data->nombre."', 
				apellido_paterno = '".$data->apellido_paterno."', 
				apellido_materno = '".$data->apellido_materno."', 
				calle = '".$data->calle."', 
				num_ext = '".$data->num_ext."', 
				num_int = '".$data->num_int."',
				colonia = '".$data->colonia."', 
				municipio = '".$data->municipio."',
				estado = '".$data->estado."',
				pais = '".$data->pais."',
				codigo_postal = '".$data->codigo_postal."',
				telefono = '".$data->telefono."',
				correo_electronico = '".$data->correo_electronico."',
				fecha_registro = '".$data->fecha_registro."',
				estatus = '".$data->estatus."' 
			WHERE id = '$id'");
			if ($sql) {
				exit(json_encode(array('status' => 'eliminado')));
			} else{
				exit(json_encode(array('status' => 'error')));
			}
		}
	}	

?>