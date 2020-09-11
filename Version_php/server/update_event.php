<?php
 	require('./conector.php');
		$con = new ConectorBD();
		//nos conectamos a la base de datos
		$response['conexion'] = $con->initConexion($con->database);
		if($response['conexion'] == 'OK'){
					$data['id'] = '"'.$_POST['id'].'"';
			    $data['fecha_inicio'] = '"'.$_POST['start_date'].'"';
			    $data['hora_inicio'] = '"'.$_POST['start_hour'].'"';
			    $data['fecha_finalizacion'] = '"'.$_POST['end_date'].'"';
			    $data['hora_finalizacion'] = '"'.$_POST['end_hour'].'"';

					if($data['id'] != 'undefined'){
						$resultado = $con->actualizarRegistro('eventos', $data, 'id ='.$data['id']); //Actualizar el registro que coincida con el id del evento a actualizar
						$response['msg'] = 'OK';
					}else{
						$response['msg'] = "Ha ocurrido un error al actualizar el evento";
					}
		}else{
		    //mensaje de error de comunicación
		    $response['msg'] = "Error en la comunicacion con la base de datos";
		}
		// se retorna el objeto codificado en json
		echo json_encode($response);
	$con->cerrarConexion()


 ?>
