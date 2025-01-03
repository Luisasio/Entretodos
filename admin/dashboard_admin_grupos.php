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
        <h1>Sección Grupos</h1>
        <p>En esta seccion se podra administrar los grupos para que sean asignados a los cursos o taller.</p>
        <br>
        <a href="agregar_grupo.php" class="btn_menu1">Agregar Grupo</a>
        <br><br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grupos</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre del Grupo</th>
                            <th style="width: 300px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "../conexion.php";
                        $todos_grupos = "SELECT * FROM grupo ORDER BY id_grupo";
                        $resultado = mysqli_query($conectar, $todos_grupos);
                        while($fila_grupo = mysqli_fetch_assoc($resultado)){
                        ?>
                        <tr>
                            <td><?php echo $fila_grupo['id_grupo'];?></td>
                            <td><?php echo $fila_grupo['nombre_grupo'];?></td>
                            <td>
                                <a href="editar_grupo.php?id=<?php echo $fila_grupo['id_grupo'];?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>&nbspEditar</a>
                                <a href="eliminar_grupo.php?id=<?php echo $fila_grupo['id_grupo'];?>" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i>&nbspEliminar</a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>