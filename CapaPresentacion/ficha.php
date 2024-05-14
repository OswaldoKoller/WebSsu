<?php
require_once "../CapaDato/conexion.php";
require_once "../CapaNegocio/Usuario.php";
require_once "../CapaNegocio/persona.php";
require_once "../CapaNegocio/especialidad.php";
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
$espe= new especialidad();
$usuarios = $usuario->obtenerusuario($database);
$personas = $persona->obtenerTodasLasPersonas();
$datos = $usuario->obtenerdatospersonausuarios();
$tespecialidad = $espe->tespecialidad();
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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
            <a href="ficha.php">
              <i class="bi bi-circle"></i><span>REGISTRAR FICHA</span>
            </a>
          </li>
          <li>
            <a href="pageerror.php">
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
      <h1>REGISTRO DE FICHA</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">REGISTRO DE FICHA</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">

    <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-6">
      <form action="../CapaNegocio/emitir_ficha.php">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Emisión de Fichas Médicas</h5>
            
            <div class="mb-3">
                <label for="selectPaciente" class="form-label">Seleccione un paciente</label>
                <select class="form-select" id="selectPaciente" name="selectPaciente">
                    <?php
                    require_once("../CapaDato/pacienteDAO.php");
                    $pacienteDAO = new pacienteDAO($database);
                    $pacientes = $pacienteDAO->mostrar();
                    if ($pacientes !== false) {
                        echo '<option value="">Seleccionar</option>';
                        foreach ($pacientes as $paciente) {
                            $idPaciente = $paciente['id_paciente'];
                            $nombre = $paciente['nombre'];
                            echo '<option value="' . $idPaciente . '">' . $idPaciente . ' - ' . $nombre . '</option>';
                        }
                    } else {
                        echo '<option value="">Error al obtener pacientes</option>';
                    }
                    ?>
                </select>
            </div>
                

            <div class="mb-3">
                  <label for="selectEspecialidad" class="form-label">Seleccione una especialidad</label>
                 <select class="form-select" id="selectEspecialidad" name="selectEspecialidad">
                      <?php
                      require_once("../CapaDato/especialidadDAO.php");
                      $especialidadDAO = new especialidadDAO($database);
                      $especialidades = $especialidadDAO->tespecialidad();

                      if ($especialidades !== false) {
                          echo '<option value="">Seleccionar</option>';
                          foreach ($especialidades as $especialidad) {
                              $idEspecialidad = $especialidad['id_especialidad'];
                              $nombreEspecialidad = $especialidad['nombre_especialidad'];
                              echo '<option value="' . $idEspecialidad . '">' . $nombreEspecialidad . '</option>';
                          }
                      } else {
                          echo '<option value="">Error al obtener especialidades</option>';
                      }
                      ?>
                  </select>
              </div>

              <div class="mb-3">
                  <label for="selectMedico" class="form-label">Seleccione un médico</label>
                  <select class="form-select" id="selectMedico" name="selectMedico">
                      <option value="1">prueba 1</option>
                      <option value="2">prueba 2</option>
                      <option value="3">prueba 3</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary" >emitirFicha</button>
              </form>
           

<script>
   function cargarMedicos() {
    var idEspecialidad = $("#selectEspecialidad").val();

    if (idEspecialidad !== "") {
        // Realizar una solicitud AJAX para obtener los médicos por especialidad
        $.ajax({
            type: 'GET',
            url: 'obtener_medicos.php?id_especialidad=' + idEspecialidad,
            success: function (data) {
                var selectMedico = $("#selectMedico");
                selectMedico.html('<option value="">Seleccionar</option>');

                // Verificar si data es un array
                if (Array.isArray(data)) {
                    data.forEach(function (medico) {
                        var option = $("<option></option>");
                        option.val(medico.id_medico);
                        option.text(medico.nombre + ' ' + medico.apellido);
                        selectMedico.append(option);
                    });
                } else {
                    // Manejar el caso en el que data no es un array
                    console.error('Los datos recibidos no son un array:', data);
                }
            },
            error: function () {
                alert('Error al cargar los médicos.');
            }
        });
    } else {
        // Limpiar el select de médicos si no se ha seleccionado una especialidad
        $("#selectMedico").html('<option value="">Seleccionar</option>');
    }
}

  function handleEspecialidadChange() {
    cargarMedicos();
  }

  $(document).ready(function () {
    // Asignar la función al evento onchange del selectEspecialidad
    $("#selectEspecialidad").on("change", handleEspecialidadChange);
  });
</script>

              <button type="button" class="btn btn-primary" onclick="emitirFicha()">Emitir Ficha</button>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  <script>
    // Agrega tu lógica de JavaScript aquí, como cargar dinámicamente las opciones de especialidades y médicos
    function emitirFicha() {
      // Agrega tu lógica para emitir la ficha médica aquí
      alert("Ficha médica emitida correctamente.");
    }
  </script>
    </section>
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SEGURO SOCIAL UNIVERSITARO</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
   
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

    
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>