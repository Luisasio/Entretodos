<?php 

require "../conexion.php";

$tipo_curso = $_POST['tipo_curso'];
$maestro = $_POST['maestro'];
$grupo = $_POST['grupo'];
$nombre_curso = $_POST['nombre_curso'];
$descripcion = $_POST['descripcion'];
$cupos = $_POST['cupos'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];


// echo $tipo_curso. "<br>";
// echo $maestro. "<br>";
// echo $grupo. "<br>";
// echo $nombre_curso. "<br>";
// echo $descripcion. "<br>";
// echo $fecha_inicio. "<br>";
// echo $fecha_fin. "<br>";

$insertar = "INSERT INTO clase (id_grupo, tipo, nombre_clase, descripcion, fecha_inicio, fecha_fin, cupos, id_maestros)
VALUES ('$grupo', '$tipo_curso', '$nombre_curso', '$descripcion', '$fecha_inicio', '$fecha_fin', '$cupos', '$maestro')";
$resultado = mysqli_query($conectar, $insertar);

if($resultado){
    echo "<script>alert('Se ha guardado el curso correctamente'); window.location='dashboard_admin_cursos.php';</script>";
}else{
    echo "<script>alert('No se pudo guardar el curso'); window.history.go(-1);</script>";
}



?>