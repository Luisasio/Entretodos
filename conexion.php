<?php 

$host = "localhost";
$usuariobd = "root";
$contrasena = "";
$basedatos = "entretodos2";

$conectar = mysqli_connect($host, $usuariobd, $contrasena, $basedatos);

if ($conectar->connect_error) {
  echo "No se pudo conectar con el servidor";
}

?>