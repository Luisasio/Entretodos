<?php
// procesar_baja.php
session_name('sesion_alumno');
session_start();
require "../conexion.php";

header('Content-Type: application/json');

if(!isset($_POST['id_clase'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$id_clase = $_POST['id_clase'];
$id_alumno = $_SESSION['id_alumno'];

mysqli_begin_transaction($conectar);

try {
    // Delete inscription
    $eliminar = "DELETE FROM inscripcion WHERE id_clase = ? AND id_alumno = ?";
    $stmt = mysqli_prepare($conectar, $eliminar);
    mysqli_stmt_bind_param($stmt, "ii", $id_clase, $id_alumno);
    mysqli_stmt_execute($stmt);

    // Increase available spots
    $actualizar = "UPDATE clase SET cupos = cupos + 1 WHERE id_clase = ?";
    $stmt = mysqli_prepare($conectar, $actualizar);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    mysqli_stmt_execute($stmt);

    mysqli_commit($conectar);
    echo json_encode(['success' => true]);
} catch(Exception $e) {
    mysqli_rollback($conectar);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>