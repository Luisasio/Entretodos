<?php
// procesar_inscripcion.php
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

// Begin transaction
mysqli_begin_transaction($conectar);

try {
    // Check available spots
    $check_cupos = "SELECT cupos FROM clase WHERE id_clase = ?";
    $stmt = mysqli_prepare($conectar, $check_cupos);
    mysqli_stmt_bind_param($stmt, "i", $id_clase);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $curso = mysqli_fetch_assoc($result);

    if($curso['cupos'] <= 0) {
        throw new Exception('No hay cupos disponibles');
    }

    // Insert inscription
    $insertar = "INSERT INTO inscripcion (id_clase, id_alumno) VALUES (?, ?)";
    $stmt = mysqli_prepare($conectar, $insertar);
    mysqli_stmt_bind_param($stmt, "ii", $id_clase, $id_alumno);
    mysqli_stmt_execute($stmt);

    // Update available spots
    $actualizar = "UPDATE clase SET cupos = cupos - 1 WHERE id_clase = ?";
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