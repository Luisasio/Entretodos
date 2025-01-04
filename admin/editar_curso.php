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
              <form action="guardar_curso.php" method="POST">
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
                        <label for="">Maestro asignado a esa materia:</label>
                        <select class="form-control" id="maestro" name="maestro">
                            <option value="" selected>Seleccione al maestro</option>
                            <?php
                            require "../conexion.php";

                            $todos_maestros = "SELECT * FROM registro_maestros ORDER BY id_maestros";
                            $resultado = mysqli_query($conectar, $todos_maestros);
                            while($fila_maestro = mysqli_fetch_assoc($resultado)){
                            ?>
                            <option value="<?php echo $fila_maestro['id_maestros'];?>"><?php echo $fila_maestro['nombre'];?>&nbsp<?php echo  $fila_maestro['apellidos']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Grupo:</label>
                        <select class="form-control" id="grupo" name="grupo">
                            <option value="" selected>Seleccione el grupo</option>
                            <?php
                            require "../conexion.php";

                            $todos_grupos = "SELECT * FROM grupo ORDER BY id_grupo";
                            $resultado = mysqli_query($conectar, $todos_grupos);
                            while($fila_grupo = mysqli_fetch_assoc($resultado)){
                            ?>
                            <option value="<?php echo $fila_grupo['id_grupo'];?>"><?php echo $fila_grupo['nombre_grupo'];?></option>
                            <?php }?>
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
                        <label for="">Seleccione la cantidad de cupos para el grupo:</label>
                        <select class="form-control" id="cupos" name="cupos">
                            <option value="" selected>Seleccione un numero valido</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
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