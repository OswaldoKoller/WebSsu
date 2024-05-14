<?php
require_once "../CapaDato/conexion.php";
require_once "../CapaNegocio/Usuario.php";
require_once "../CapaNegocio/persona.php";
require_once "../CapaDato/UsuarioDao.php";
// include_once "../CapaNegocio/update2.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$database = new Database();
$persona = new persona();
$usuario = new usuario($database);
$datosUsuario = $database->obtenerDatosUsuario($username);
$usuarios = $usuario->obtenerusuario($database);
$personas = $persona->obtenerTodasLasPersonas();
$datos = $usuario->obtenerdatospersonausuarios();
$username = $_SESSION['username'];
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
  <link href="assets/img/logo_redondo.jpg" rel="icon">
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


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo redondo.jpg" alt="">
        <span class="d-none d-lg-block">S.S.U</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="index.php">
            <i class="bi bi-search"></i>
          </a>
        

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/tarjeta.png" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $username; ?></h6>
              
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Mis datos</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="cerrarsesion.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Cerrar sesion</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.php">
          <i class="bi bi-grid"></i>
          <span>INICIO</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>ACCESO Y SEGURIDAD</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="pages-blank.php">
              <i class="bi bi-circle"></i><span>ADMINISTRAR USUARIO</span>
            </a>
          </li>
          <li>
            <a href="roles.php">
              <i class="bi bi-circle"></i><span>ADMINISTRAR ROL</span>
            </a>
          </li>
          <li>
            <a href="asignacion.php">
              <i class="bi bi-circle"></i><span>ADMINISTRAR USUARIO ROL</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>PARAMETRIZACION</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="medicos.php">
              <i class="bi bi-circle"></i><span> ADMINISTRAR MEDICO</span>
            </a>
          </li>
          <li>
            <a href="paciente.php">
              <i class="bi bi-circle"></i><span> ADMINISTRAR PACIENTE</span>
            </a>
          </li>
          <li>
            <a href="especialidad.php">
              <i class="bi bi-circle"></i><span>ADMINISTRAR ESPECIALIDAD</span>
            </a>
          </li>          
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>TRANSACCIONALES</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="ficha2.php">
              <i class="bi bi-circle"></i><span>REGISTRAR FICHA</span>
            </a>
          </li>
          <li>
            <a href="busca_paciente_historial.php">
              <i class="bi bi-circle"></i><span>HISTORIAL CLINICO</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>REPORTES</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="reporte.php">
              <i class="bi bi-circle"></i><span>REPORTE DE FICHA</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Tables Nav -->

      <!-- End Blank Page Nav -->

    </ul>

  </aside>
  <main id="main" class="main">
    <h1>LISTADO DE PACIENTES POR MEDICO</h1>
    <?php
    // historia_paciente.php

    // Aquí incluirías tus archivos de conexión a la base de datos y cualquier otro archivo necesario
    require_once("../CapaDato/conexion.php");
    require_once("../CapaDato/medicoDAO.php");
    $db = new database();
    $medicoDAO = new medicoDAO($db);
    // Verifica si se recibió el ID del médico por POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtén el ID del médico desde la solicitud POST
        $idMedico = $_POST['id_medico'];

        // Realiza la consulta SQL para obtener los pacientes del médico
        $pacientes = $medicoDAO->obtenerPacientesPorMedico($idMedico);

        // Construye la tabla de pacientes
        if ($pacientes !== false) {
            echo '<table class="table">';
            echo '<thead><tr><th>ID Ficha</th><th>ID Paciente</th><th>Nombre</th><th>Apellido</th><th>Fecha_ficha</th><th>Acciones</th></tr></thead>';
            echo '<tbody>';
            foreach ($pacientes as $paciente) {
                echo '<tr>';
                echo '<td>' . $paciente['id_ficha'] . '</td>';
                echo '<td>' . $paciente['id_paciente'] . '</td>';
                echo '<td>' . $paciente['nombre_paciente'] . '</td>';
                echo '<td>' . $paciente['apellido_paciente'] . '</td>';
                echo '<td>' . $paciente['fecha_atencion'] . '</td>';
                echo '<td><a class="btn btn-primary" href="historial.php?id_ficha=' . $paciente['id_ficha'] . '">Seleccionar</a></td>';
                echo '</tr>';
            
            }
            echo '</tbody></table>';
        } else {
            echo 'Error al obtener pacientes';
        }
    } else {
        echo 'Solicitud no válida';
    }
    ?>
    </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SEGURO SOCIAL UNIVERSITARIO</span></strong>. 
    </div>
  </footer><!-- End Footer -->

  





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