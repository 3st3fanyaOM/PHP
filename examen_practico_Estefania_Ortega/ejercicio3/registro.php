<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
  </head>
  <body>
    <h1>REGISTRO</h1><hr>
    <form action="registrar.php" method="POST" name="datosUsuario" enctype=""multipart/form-data>
      <label>Nombre:</label><br>
      <input type="text" id="nombre" /><br>
      <label>Apellidos:</label><br>
      <input type="text" id="apellidos" /><br>
      <label>DNI:</label><br>
      <input type="text" id="dni" /><br>
      <label>Foto:</label><br>
      <input type="file" id="foto" /><br>
      <label>Usuario:</label><br>
      <input type="text" id="usuario" /><br>
      <label>Contraseña:</label><br>
      <input type="text" id="contrasenia" /><br><br>
      
      <input type="submit" name="Añadir" /><br />
    </form>
  </body>
</html>