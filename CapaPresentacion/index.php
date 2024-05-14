<?php
require_once "../CapaDato/conexion.php";
require_once "../CapaDato/UsuarioDao.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$database = new Database();
$username = $_SESSION['username'];
$datosUsuario = $database->obtenerDatosUsuario($username);
$personaId = $datosUsuario['id_persona'];
$datosPersona = $database->obtenerDatosPersona($personaId);
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
            <a href="ficha.php">
              <i class="bi bi-circle"></i><span>REPORTE DE FICHA</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End Tables Nav -->

      <!-- End Blank Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Inicio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
          <li class="breadcrumb-item active">Admistración</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
   
    <section class="section dashboard">
    <!-- Left side columns -->
    <div class="row">
        <!-- Sales Card 1 -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h5 class="card-title">ACCESO Y SEGURIDAD <span>| atajo</span></h5>
                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/registro-en-linea.png" alt="">
                                <h4><a href="pages-blank.php">ADMINISTRAR USUARIO</a></h4>
                                <p>administracion de usuario, registrar, buscar, modificar y eliminar un usuario.</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/roles.png" alt="">
                                <h4><a href="roles.php">ADMINISTRAR DE ROLES</a></h4>
                                <p>Registro de roles de manera rápida y sencilla.</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/afiliacion.png" alt="">
                                <h4><a href="asignacion.php">ADMINISTRAR DE USUARIO - ROL</a></h4>
                                <p>Asignacion de usuario y roles  de manera rápida y sencilla.</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- Sales Card 2 -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h5 class="card-title">PARAMETRIZACION <span>| atajo</span></h5>
                        <div class="news">
                            <div class="post-item clearfix">
                                <img src="assets/img/roles.png" alt="">
                                <h4><a href="medicos.php">ADMINISTRITAR MEDICO</a></h4>
                                <p>Registra un medico de manera rápida y sencilla</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/paciente.png" alt="">
                                <h4><a href="paciente.php">ADMINISTRAR DE PACIENTE</a></h4>
                                <p>Registra un paciente de manera rápida y sencilla</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/especialidad.png" alt="">
                                <h4><a href="especialidad.php">ADMINISTRAR DE ESPECIALIDAD</a></h4>
                                <p>Registra una especialidad de manera rápida y sencilla</p>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sales Card 3 -->
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h5 class="card-title">TRANSACCIONALES <span>| atajo</span></h5>
                        <div class="news">
                        <div class="post-item clearfix">
                                <img src="assets/img/atencion-al-cliente.png" alt="">
                                <h4><a href="ficha2.php">FICHA</a></h4>
                                <p>Emision de fichas a los pacientes</p>
                            </div>
                            <div class="post-item clearfix">
                                <img src="assets/img/historial-medico.png" alt="">
                                <h4><a href="busca_paciente_historial.php">HISTORIAL CLINICO</a></h4>
                                <p>Registro de historial clinico de los pacientes </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
                <div class="card">
                    <div class="card-body pb-1">
                        <h5 class="card-title">REPORTES <span>| atajo</span></h5>
                        <div class="news">
                        <div class="post-item clearfix">
                                <img src="assets/img/reporte-de-negocios.png" alt="">
                                <h4><a href="pageerror.php">REPORTES DE FICHA</a></h4>
                                <p>Emision de fichas a los pacientes</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SEGURO SOCIAL UNIVERSITAROP</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    </div>
  </footer><!-- End Footer -->


  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>