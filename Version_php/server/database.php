<?php 
	require('./conector.php');
	$con = new ConectorBD(); //instanciamos la conexión
	$response['msg'] = $con->verifyConexion();//Verificamos que se conecte
	return $response['msg']; //Retornamos el resultado.

 ?>
