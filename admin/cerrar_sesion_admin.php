// cerrar_sesion_admin.php
<?php
session_name('sesion_admin');
session_start();
session_destroy();
setcookie("usuario_admin", "", time() - 3600);
header("Location: ../index.php");
?>