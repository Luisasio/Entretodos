<?php
require "conexion.php";

$correo = addslashes($_POST['correo']);
$contrasena = addslashes($_POST['contrasena']);
$tipo_usuario = $_POST['tipo_usuario'];

function autenticarUsuario($conectar, $correo, $contrasena, $tabla) {
    $stmt = $conectar->prepare("SELECT * FROM $tabla WHERE correo = ? LIMIT 1");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_array();
        if (password_verify($contrasena, $fila['contrasena'])) {
            return $fila;
        }
    }
    return false;
}

switch ($tipo_usuario) {
    case 'alumno':
        session_name('sesion_alumno');
        session_start();
        if ($usuario = autenticarUsuario($conectar, $correo, $contrasena, 'registro_alumnos')) {
            $_SESSION['username'] = $correo;
            $_SESSION['tipo_usuario'] = 'alumno';
            $_SESSION['id_alumno'] = $usuario['id_alumno'];
            $_SESSION["autentificado"] = "SI";
            setcookie("usuario_alumno", $correo, time() + 3600);
            header("Location: alumno/dashboard_alumno.php");
            exit();
        }
        break;

    case 'maestro':
        session_name('sesion_maestro');
        session_start();
        if ($usuario = autenticarUsuario($conectar, $correo, $contrasena, 'registro_maestros')) {
            $_SESSION['username'] = $correo;
            $_SESSION['tipo_usuario'] = 'maestro';
            $_SESSION['id_maestro'] = $usuario['id_maestro'];
            $_SESSION["autentificado"] = "SI";
            setcookie("usuario_maestro", $correo, time() + 3600);
            header("Location: maestro/dashboard_maestro.php");
            exit();
        }
        break;

    case 'administrador':
        session_name('sesion_admin');
        session_start();
        if ($usuario = autenticarUsuario($conectar, $correo, $contrasena, 'registro_administradores')) {
            $_SESSION['username'] = $correo;
            $_SESSION['tipo_usuario'] = 'administrador';
            $_SESSION['id_administrador'] = $usuario['id_administrador'];
            $_SESSION["autentificado"] = "SI";
            setcookie("usuario_admin", $correo, time() + 3600);
            header("Location: admin/dashboard_admin.php");
            exit();
        }
        break;

    default:
        header("Location: index.php?error=tipo_invalido");
        exit();
}

// Si la autenticación falla
header("Location: index.php?errorusuario=SI");
exit();
?>