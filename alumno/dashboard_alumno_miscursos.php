<?php
session_name('sesion_alumno');
session_start();
if (!isset($_SESSION["autentificado"]) || $_SESSION["autentificado"] != "SI") {
    header("Location: ../index.php");
    exit();
}
require "../conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Cursos</title>
    <script src="https://kit.fontawesome.com/fe8b02346c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo_alumno.css">
</head>
<body>
    <?php include "sidebar_alumno.php";?>
    <div class="content">
        <?php include "navbar_alumno.php"?>
        <br>
        <h1>Mis Cursos</h1>
        <p>Cursos en los que estás inscrito</p>
        <br>
        <div class="py-3 contenedor-cursos">
            <?php
            $mis_cursos = "SELECT c.*, rm.nombre, rm.apellidos, g.nombre_grupo 
                          FROM clase c
                          INNER JOIN registro_maestros rm ON c.id_maestros = rm.id_maestros 
                          INNER JOIN grupo g ON c.id_grupo = g.id_grupo
                          INNER JOIN inscripcion i ON c.id_clase = i.id_clase
                          WHERE i.id_alumno = {$_SESSION['id_alumno']}";
            $resultado = mysqli_query($conectar, $mis_cursos);
            while($curso = mysqli_fetch_assoc($resultado)){
            ?>
            <div class="card tarjeta-curso">
                <div class="card-header">
                    <h3 class="card-title"><?php echo $curso["nombre_clase"]?></h3>
                </div>
                <div class="card-body">
                    <p><b>Tipo:</b> <?php echo $curso["tipo"]?></p>
                    <p><b>Docente:</b> <?php echo $curso["nombre"]?> <?php echo $curso["apellidos"]?></p>
                    <p><b>Grupo:</b> <?php echo $curso["nombre_grupo"]?></p>
                    <p><b>Descripción:</b> <?php echo $curso["descripcion"]?></p>
                </div>
                <div class="acciones-curso">
                    <button class="btn btn-danger dar-baja" 
                            data-clase="<?php echo $curso['id_clase'];?>"
                            data-nombre="<?php echo $curso['nombre_clase'];?>">
                        <i class="fa-solid fa-user-minus"></i>&nbsp;Dar de baja
                    </button>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.dar-baja').click(function() {
            const claseId = $(this).data('clase');
            const nombreClase = $(this).data('nombre');
            
            if(confirm(`¿Deseas darte de baja del curso "${nombreClase}"?`)) {
                $.ajax({
                    url: 'procesar_baja.php',
                    method: 'POST',
                    data: { id_clase: claseId },
                    success: function(response) {
                        if(response.success) {
                            alert('Te has dado de baja exitosamente');
                            location.reload();
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error al procesar la baja');
                    }
                });
            }
        });
    });
    </script>
</body>
</html>