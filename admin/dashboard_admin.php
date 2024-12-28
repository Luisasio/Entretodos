<?php
session_name('sesion_admin');
session_start();
if (!isset($_SESSION["autentificado"]) || $_SESSION["autentificado"] != "SI") {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador</title>
    <script src="https://kit.fontawesome.com/fe8b02346c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo_panel.css">
    <style>
        body {
            display: flex;
        }
    </style>
</head>
<body>
    <?php include "sidebar_admin.php";?>
    <div class="content">
        <?php include "navbar_admin.php"?>
        <br>
        <h1>Bienvenido al Dashboard</h1>
        <p>Esta es la sección principal del dashboard del Administrador.</p>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>