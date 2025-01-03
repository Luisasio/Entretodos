<?php

require "../conexion.php";

$nombre_grupo = $_POST['nombre_grupo'];

// echo $nombre_grupo;

$insertar = "INSERT INTO grupo (nombre_grupo) VALUES ('$nombre_grupo')";

$resultado = mysqli_query($conectar, $insertar);

if ($resultado) {
    echo '
    <script>
      alert("SE GUARDO CORRECTAMENTE");
      location.href="dashboard_admin_grupos.php";
    </script>
  ';
} else {
    echo "Error al guardar";
}






?>