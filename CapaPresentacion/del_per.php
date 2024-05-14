<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/usuario.php';
require_once '../CapaNegocio/persona.php';
session_start();

if (!isset($_SESSION['username'])) {
    // Redirecciona o realiza alguna acción si el usuario no está autenticado
    exit();
}

$db = new database();
$usuario = new Usuario($db);
$persona = new Persona($db);
$mensaje = "";

// Cuando se envía el formulario de búsqueda
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarUsuario = $_POST['buscar_usuario'];

    // Buscar el usuario por el nombre de usuario
    $datosUsuario = $usuario->buscarUsuario($buscarUsuario);
    $datoPersona = $persona->obtenerDatosPersona($datosUsuario['id_persona']);
    if ($datosUsuario) {
        $_SESSION['usuarioIdBuscar'] = $datosUsuario['id_usuario'];
        $_SESSION['personaIdBuscar'] = $datosUsuario['id_persona'];
        $_SESSION['usernameBuscar'] = $datosUsuario['nombre_usuario'];
        $_SESSION['passwordBuscar'] = $datosUsuario['pass_usuario'];
        $_SESSION['nombre_personaBuscar'] = $datoPersona['nombre'];
        $_SESSION['apellido_personaBuscar'] = $datoPersona['apellido'];
        $_SESSION['telefono_personaBuscar'] = $datoPersona['telefono'];
    } else {
        $mensaje = "No se encontró ningún usuario con el nombre de usuario: $buscarUsuario";
    }
}

// Cuando se envía el formulario de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $usuarioIdEliminar = $_SESSION['usuarioIdBuscar'] ?? '';
    $personaIdEliminar = $_SESSION['personaIdBuscar'] ?? '';

    if (!empty($usuarioIdEliminar) && !empty($personaIdEliminar)) {
        // Cambiar el estado del usuario y la persona a 0 para desactivarlos
        $resultadoUsuario = $usuario->eliminar($usuarioIdEliminar);
        $resultadoPersona = $persona->eliminar($personaIdEliminar);

        if ($resultadoUsuario && $resultadoPersona) {
            $mensaje = "El usuario y la persona se han eliminado correctamente.";
        } else {
            $mensaje = "Error al eliminar el usuario y la persona.";
        }

        // Redirigir de nuevo a la página principal
        header("Location: pages-blank.php");
        exit; // Asegurarse de que no se ejecuta más código después de la redirección
    }else{
        header("Location: del_per.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Seguro Social Uniuversitario</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo redondo.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
    <div class="container">
        <h1>Editar Usuario</h1>
        <?php if (!empty($mensaje)): ?>
            <div class="alert <?php echo ($resultadoUsuario && $resultadoPersona) ? 'alert-success' : 'alert-danger'; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" onsubmit="return validarFormulario()">
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="buscar_usuario" class="form-control">
                        <small id="errorMensaje" class="form-text text-danger"></small>
                    </div>
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                    <script>
                    function validarFormulario() {
                     var nombreUsuario = document.getElementById('buscar_usuario').value;

            // Verifica que el campo no esté vacío
                     if (nombreUsuario.trim() === '') {
                     document.getElementById('errorMensaje').innerText = 'Por favor, ingrese un nombre de usuario.';
                    return false;
            }

            // Puedes agregar más validaciones según sea necesario

            // Si todas las validaciones pasan, retorna true para enviar el formulario
            return true;
        }
    </script>
                </form>
            </div>
            <?php if (isset($datosUsuario)): ?>
                <div class="col-md-6">
                    <form method="POST">
                        <!-- Mostrar los datos en una tabla -->
                        <table class="table">
                            <tr>
                                <th>Nombre de Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Acción</th>
                            </tr>
                            <tr>
                                <td><?php echo $_SESSION['usernameBuscar']; ?></td>
                                <td><?php echo $_SESSION['nombre_personaBuscar']; ?></td>
                                <td><?php echo $_SESSION['apellido_personaBuscar']; ?></td>
                                <td><?php echo $_SESSION['telefono_personaBuscar']; ?></td>
                                <td>
                                    <button type="submit" name="eliminar" class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Agrega tus scripts y hojas de estilo aquí -->
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
        <?php include "modificar_usuario.php"; ?>
  





  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
    
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
