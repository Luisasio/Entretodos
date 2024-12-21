<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo_panel.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="img/entretodos_logo.png" alt="Logo" width="200" height="50" class="d-inline-block align-text-top">
            </a>
        </div>
    </nav>
    <div class="container">
        <h2 class="text-center py-4">Bienvenido al registro para maestros</h2>
        </div>
    
        <form action="guardar_maestros.php" class="diseño_formulario" method="post">

        <h3 class="text-center">Maestros</h3>
        <p class="text-center">Por favor ingresa tus datos</p>

        <label class="py-2" for="">Nombre</label>
                    <input class="form-control tamaño_form" type="text" name="nombres" id="" placeholder="Juanito Alberto">

                    <label class="py-2" for="">Apellidos</label>
                    <input class="form-control tamaño_form" type="text" name="apellidos" id="" placeholder="Perez Gonzales">


                    <label class="py-2" for="">Correo</label>
                    <input class="form-control tamaño_form" type="text" name="correo" id="" placeholder="Correo@ejemplo.com">
                    <label class="py-2" for="">Contraseña</label>
                    <div style="position: relative;">
                        <input class="form-control" type="password" name="contrasena" id="passwordInput" placeholder="password">
                        <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); border: none; background: none; cursor: pointer;">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                        </div>
                        <br>


                        <button class="btn_ingresar" type="submit">Registrar</button>


        </form>
     
        <script>
        // Agregando el evento al botón del ojo
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');

            // Alternar entre texto y contraseña
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
