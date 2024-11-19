<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0" />
    <title>Formulario de registro</title>
  </head>
  <body>
    <h1>REGISTRO</h1><hr>
    <form action="registrar.php" method="POST" name="datosUsuario" enctype="multipart/form-data">
      <label>Nombre:</label><br>
      <input type="text" name="nombre" /><br>
      <label>Apellidos:</label><br>
      <input type="text" name="apellidos" /><br>
      <label>DNI:</label><br>
      <input type="text" name="dni" /><br>
      <label>Foto:</label><br>
      <input type="file" name="foto" /><br>
      <label>Usuario:</label><br>
      <input type="text" name="usuario" /><br>
      <label>Contraseña:</label><br>
      <input type="text" name="contrasenia" /><br><br>
      
      <input type="submit" name="Añadir" />
      <input type="reset">
    </form>
  </body>
</html>