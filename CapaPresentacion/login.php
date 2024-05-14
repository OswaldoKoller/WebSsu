<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="assets/img/logo-redondo.jpg" rel="icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-light-green {
            background-color: #c3e6cb;
        }

        .container {
            position: relative;
            z-index: 1;
        }

        .card {
            border: none;
            border-radius: 10px;
            margin-top: 50px;
        }

        .card-body {
            padding: 40px;
        }

        .col-lg-6:first-child {
          
            background-size: cover;
            border-radius: 10px 10px 0 0;
            margin-bottom: 20px; /* Añadido para mover la imagen hacia abajo */
        }

        .col-lg-6 {
            border-radius: 0 0 10px 10px;
        }

        .h4 {
            color: #333;
        }

        .form-control-user {
            border-radius: 25px;
            padding: 15px;
        }

        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary {
            background-color: #4e73df;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
        }
    </style>
</head>

<body class="bg-light-green">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/logo.png" alt="">
                                        <h1 class="h4">BIENVENIDO</h1>
                                    </div>
                                    <form id="loginForm" method="POST" action="../CapaNegocio/login_user.php" class="user" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="INGRESE SU USUARIO">
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="INGRESE SU CONTRASEÑA">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="cursor: pointer;" onclick="togglePasswordVisibility()">
                                                        <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Recordarme</label>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success btn-user btn-block">Ingresar</button>
                                       
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            // Puedes agregar aquí tus validaciones adicionales antes de enviar el formulario.
            // Por ejemplo, verificar que el nombre de usuario y la contraseña no estén vacíos.
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            if (username.trim() === '' || password.trim() === '') {
                alert('Por favor, ingrese tanto el nombre de usuario como la contraseña.');
                return false;
            }

            // Puedes agregar más validaciones según tus requisitos.

            return true; // Si todas las validaciones pasan, se envía el formulario.
        }

        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var icon = document.getElementById('togglePasswordIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.className = 'fas fa-eye-slash'; // Cambia el ícono a ojo tachado cuando la contraseña es visible.
            } else {
                passwordField.type = 'password';
                icon.className = 'fas fa-eye'; // Cambia el ícono a ojo cuando la contraseña está oculta.
            }
        }
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>

</html>
