var Usuario = require('./modelUsuarios.js') 

module.exports.crearUsuarioDemo = function(callback){ 
	//creamos los usuarios
  var arr = [{ email: 'demo@gmail.com', user: "demo", password: "123456"}, { email: 'carlos@gmail.com', user: "carlos", password: "123456"}]; //array con la información de los usuarios a insertar
  Usuario.insertMany(arr, function(error, docs) {
    if (error){
      if (error.code == 11000){ //Verificar si el nombre de usuario (PrimaryKey) del existe
        callback("Utilice los siguientes datos: </br>usuario: demo | password:123456 </br>usuario: carlos | password:123456")
      }else{
        callback(error.message) //Mostrar mensaje de error
      }
    }else{
      callback(null, "El usuario 'demo' y 'juan' se ha registrado correctamente. </br>usuario: demo | password:123456 </br >usuario: carlos | password:123456")
    }
  });
}
