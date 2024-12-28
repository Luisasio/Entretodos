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
        <h1>Agregar Cursos</h1>
        <p>En esta seccion se podra agregar los cursos que estaran disponibles.</p>
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detalles del curso</h3>
              </div>
              <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Seleccione la modalidad del curso:</label>
                        <select class="form-control" id="tipo_curso" name="tipo_curso">
                            <option value="" selected>Seleccione una modalidad</option>
                            <option value="Taller">Taller</option>
                            <option value="Curso">Curso</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_curso">Nombre del curso:</label>
                        <input type="text" class="form-control" id="nombre_curso" name="nombre_curso" placeholder="Nombre del curso">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de inicio:</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha de fin:</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                    </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn-guardar-curso">Guardar </button>
                  <a href="dashboard_admin_cursos.php" class="btn-cancelar-curso" style="margin-left: 10px;">Cancelar</a>
                </div>
              </form>
        </div>
        <div class="py-4">
            
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>