<?php
session_name('sesion_alumno');
session_start();
session_destroy();
setcookie("usuario_alumno", "", time() - 3600);
header("Location: ../index.php");
?>