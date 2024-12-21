<?php 
require "conexion.php";

$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$correo=$_POST['correo'];
$contrasena=$_POST['contrasena'];

$contrasena_encriptada=password_hash($contrasena, PASSWORD_DEFAULT);



$insertar = "INSERT INTO registro_maestros(nombre, apellidos, correo,contrasena) VALUES ('$nombres','$apellidos','$correo','$contrasena_encriptada')";


$verificar_usuario=mysqli_query($conectar, "SELECT * FROM  registro_maestros WHERE correo='$correo'");
if(mysqli_num_rows($verificar_usuario)>0)
{
  echo 
  '
  <script>

  alert("EL USUARIO YA EXISTE");  
  location.href="registro_maestros.php"; 

  </script>
  
  
  ';
  exit;
}

$query = mysqli_query($conectar, $insertar);

if ($query) {
  echo '
<script>
  alert("SI SE GUARDARON LOS DATOS CORRECTAMENTE");
  location.href="registro_maestros.php";
</script>
';
} 
else {
  echo '
<script>
  alert("NO SE GUARDO CORRECTAMENTE INTENTE DE NUEVO");
  windows.history.go(-1);
</script>
';
}






?>