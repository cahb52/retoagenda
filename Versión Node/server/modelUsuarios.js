let mongoose = require('mongoose'),
    Schema = mongoose.Schema 
//definimos el schema a utilizar
let UserSchema = new Schema({ 
  user: { type: String, required: true, unique: true}, 
  email: { type: String, required: true }, 
  password: { type: String, required: true},
  })

let UsuarioModel = mongoose.model('Usuario', UserSchema)

module.exports = UsuarioModel
