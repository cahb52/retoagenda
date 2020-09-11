<?php
  	require('./conector.php');
$con = new ConectorBD();
$response['conexion'] = $con->initConexion($con->database);
if($response['conexion'] == 'OK'){
    //se crea el arreglo para el envío de información
    $data['titulo'] = '"'.$_POST['titulo'].'"';
    $data['fecha_inicio'] = '"'.$_POST['start_date'].'"';
    $data['hora_inicio'] = '"'.$_POST['start_hour'].':00"';/*agregamos ":00" esto complementa el formato de hora*/
    $data['fecha_fin'] = '"'.$_POST['end_date'].'"';
    $data['hora_fin'] = '"'.$_POST['end_hour'].':00"'; /*Agregamos ":00" para complementar el formato de tiempo*/
    $data['allday'] = $_POST['allDay'];
    $data['fk_usuarios'] = '"'.$_SESSION['email'].'"';

    if($con->insertData('eventos', $data)){ //Se insertan los datos en la base de datos
        $resultado = $con->consultar(['eventos'],['MAX(id)']); //Obtenemos el id del registro ingresado
        while($fila = $resultado->fetch_assoc()){
          $response['id']=$fila['MAX(id)']; 
        }
        $response['msg'] = 'OK';
    }else{
        $response['msg'] = "Ocurrió un error al guardar el evento";
    }
}else{
    $response['msg'] = "No se pudo establecer comunicación con la base de datos";
}
echo json_encode($response);


 ?>
