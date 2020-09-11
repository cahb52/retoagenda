<?php
require('conector.php'); 
$con = new ConectorBD(); //Instanciamos la conexión
$usuarios = new Usuarios(); //Instanciamos la clase usuarios
$eventos = new Eventos(); //Instanciamos la clase eventos
//Inicializar varialbes
$response['detalle'] = "Se han encontrado los siguientes errores:</br><ol>";
$resonse['usuarios'] = "";
$response['eventos']='';

//Creación de las tablas a utilizar en la base de datos
$result = $con->crearTabla($usuarios->nombreTabla, $usuarios->data); //creamos la tabla
if( $result == "OK"){ //Comprobamos si el resultado devuelto fue ok
  $response['msg'] = 'OK';
  $response['detalle'] = "OK";
  $response['usuarios'] = 'OK';
}else{ //De lo contrario mostramos un error
  $response['detalle'] .= "<li>No se pudo crear la tabla de usuarios.</li>";
}
//Creamos la tabla eventos
$result = $con->crearTabla($eventos->nombreTabla, $eventos->data);
if( $result == "OK"){ //Comprobamos si se creo correctamente
  $response['msg'] = 'OK';
  $response['detalle'] = "OK";
  $response['eventos'] = 'OK';
}else{ //Si no se creo mostrarmos un error
  $response['detalle'] .= "<li>Ocurrió un error al crear la tabla eventos.</li>";
}

if($response['eventos'] =='OK' AND $response['usuarios'] == 'OK' ){ //se comprueba que las tablas fueron creadas correctamente
  //se crea una llave foranea entre las tablas
  $result =  $con->nuevaRestriccion($eventos->nombreTabla, 'ADD KEY fk_usuarios (fk_usuarios)');
  if( $result == "OK"){
    $response['Index'] = 'OK';
    $response['detalle'] = 'OK';
  }
  //Se crea una relación entre ambas tablas
  $result =  $con->nuevaRelacion($eventos->nombreTabla, $usuarios->nombreTabla, 'fk_usuarioemail_evento', 'fk_usuarios', 'email'); //nombre de la tabla origen, nomvre tabla destino, nombre de la clave foranea, nombre de la columna origen, nombre de columna destino
  if( $result == "OK"){
    $response['Clave Foránea'] = 'OK';
    $response['detalle'] = 'OK';
  }
}else{
  $response['detalle'] .='</ul> </br>Compruebe que el usuario utilizado en la conexión tiene con permisos administrativos para realizar estas acciones';
  $response['msg'] = $response['detalle'];
}

echo json_encode($response); //Se retorna el resultado
?>
