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
        <h1>Sección Cursos</h1>
        <p>En esta seccion se podra administrar los cursos que estaran disponibles.</p>
        <br>
        <a href="agregar_curso.php" class="btn_menu1">Agregar Cursos</a>
        <br>
        <div class="py-3 contenedor-cursos">
            <?php
            require "../conexion.php";

            $todos_cursos = "SELECT * FROM clase 
                                INNER JOIN registro_maestros ON clase.id_maestros = registro_maestros.id_maestros 
                                INNER JOIN grupo ON clase.id_grupo = grupo.id_grupo;";
            $resultado = mysqli_query($conectar, $todos_cursos);
            while($fila_curso = mysqli_fetch_assoc($resultado)){
            ?>
            <!-- tarjeta de los cursos -->
            <div class="card  tarjeta-curso">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $fila_curso["nombre_clase"]?></h3>
                </div>
                <div class="card-body">
                    <p><b>Tipo:</b> <?php echo $fila_curso["tipo"]?></p>
                    <p><b>Docente:</b> <?php echo $fila_curso["nombre"]?><?php echo $fila_curso["apellidos"]?></p>
                    <p><b>Cupos disponibles:</b> <?php echo $fila_curso["cupos"]?></p>
                    <p><b>Grupo:</b> <?php echo $fila_curso["nombre_grupo"]?></p>
                    <p><b>Descripcion:</b> <?php echo $fila_curso["descripcion"]?></p>
                </div>
                <div class="acciones-curso">
                    <a href="editar_curso.php?id_clase=<?php echo $fila_curso['id_clase'];?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i>&nbspEditar</a>
                    <a href="eliminar_curso.php?id_clase=<?php echo $fila_curso['id_clase'];?>" class="btn btn-danger"><i class="fa-solid fa-trash-can" aria-hidden="true"></i>&nbspEliminar</a>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>