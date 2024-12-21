<?php
session_name('sesion_maestro');
session_start();
session_destroy();
setcookie("usuario_maestro", "", time() - 3600);
header("Location: ../index.php");
?>