<?php
session_name('sesion_alumno');
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
    <link rel="stylesheet" href="../css/estilo_alumno.css">
    <style>
        body {
            display: flex;
        }
    </style>
</head>
<body>
    <?php include "sidebar_alumno.php";?>
    <div class="content">
        <?php include "navbar_alumno.php"?>
        <br>
        <h1>Sección Cursos</h1>
        <p>Aqui podrás inscribirte a un curso.</p>
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
                <!-- Modify the card actions div -->
<div class="acciones-curso">
    <?php
    // Check if student is already enrolled
    $check_inscription = "SELECT * FROM inscripcion WHERE id_alumno = {$_SESSION['id_alumno']} AND id_clase = {$fila_curso['id_clase']}";
    $result_check = mysqli_query($conectar, $check_inscription);
    
    if(mysqli_num_rows($result_check) > 0) {
        echo '<button class="btn btn-secondary" disabled>Ya inscrito</button>';
    } else {
        // Check if there are available spots
        if($fila_curso['cupos'] > 0) {
            echo "<button class='btn btn-primary inscribir-btn' 
                  data-clase='{$fila_curso['id_clase']}'
                  data-nombre='{$fila_curso['nombre_clase']}'>
                  <i class='fa-solid fa-user-plus'></i>&nbsp;Inscribirse
                  </button>";
        } else {
            echo '<button class="btn btn-secondary" disabled>Sin cupos</button>';
        }
    }
    ?>
</div>
            </div>
            <?php }?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Esta parte es la de confirmar la inscripcion -->

<script>
$(document).ready(function() {
    $('.inscribir-btn').click(function() {
        const claseId = $(this).data('clase');
        const nombreClase = $(this).data('nombre');
        
        if(confirm(`¿Deseas inscribirte al curso "${nombreClase}"?`)) {
            $.ajax({
                url: 'procesar_inscripcion.php',
                method: 'POST',
                data: { id_clase: claseId },
                success: function(response) {
                    if(response.success) {
                        alert('Inscripción exitosa');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error al procesar la inscripción');
                }
            });
        }
    });
});
</script>



</body>
</html>