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

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Emisión de Fichas Médicas</h5>
            <!--<form action="../CapaNegocio/emitir_ficha.php" method="post">-->
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

<!-- Nueva tabla para mostrar médicos -->
<div class="mb-3">
    <h5>Médicos disponibles</h5>
    <table class="table">
        <thead>
            <tr>
                <th>ID Médico</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Especialidad</th>
                <th>Seleccionar</th>
            </tr>
        </thead>
        <tbody id="tablaMedicos">
            
            
        </tbody>
    </table>
</div>

              

<script>
    function cargarMedicos() {
        var idEspecialidad = $("#selectEspecialidad").val();

        if (idEspecialidad !== "") {
            // Realizar una solicitud AJAX para obtener los médicos por especialidad
            $.ajax({
                type: 'GET',
                url: 'obtener_medicos.php?id_especialidad=' + idEspecialidad,
                dataType: 'json',
                success: function (data) {
                    mostrarMedicosEnTabla(data);
                },
                error: function (xhr, status, error) {
                    console.error('Error al cargar los médicos:', status, error);
                    alert('Error al cargar los médicos.');
                }
            });
        } else {
            // Limpiar la tabla si no se ha seleccionado una especialidad
            $("#tablaMedicos").empty();
        }
    }

    function mostrarMedicosEnTabla(data) {
        var tablaMedicos = $("#tablaMedicos");
        tablaMedicos.empty();

        if ($.isArray(data)) {
            data.forEach(function (medico) {
                var row = $("<tr></tr>");
                row.append("<td>" + medico.id_medico + "</td>");
                row.append("<td>" + medico.nombre + "</td>");
                row.append("<td>" + medico.apellido + "</td>");
                row.append("<td>" + medico.nombre_especialidad + "</td>");

                var botonSeleccionar = $("<button class='btn btn-primary'>Seleccionar</button>");
                botonSeleccionar.click(function () {
                    // Llamada a la función para manejar la selección del médico
                    handleSeleccionarMedico(medico.id_medico);
                    //console.log(medico.id_medico);
                });

                var tdBoton = $("<td></td>");
                tdBoton.append(botonSeleccionar);

                row.append(tdBoton);
                tablaMedicos.append(row);
            });
        } else {
            console.error('Los datos recibidos no son un array:', data);
            alert('Error al cargar los médicos: los datos no son un array');
        }
    }

    function handleEspecialidadChange() {
        cargarMedicos();
    }

    $(document).ready(function () {
        $("#selectEspecialidad").on("change", handleEspecialidadChange);
    });

    function handleSeleccionarMedico(idMedico) {
        // $("#selectMedicoHidden").val(idMedico);

        var selectPaciente = $("#selectPaciente").val();
         var selectEspecialidad = $("#selectEspecialidad").val();
          console.log(idMedico);
          console.log(selectPaciente);
          console.log(selectEspecialidad);
        $.ajax({
            type: 'POST',
            url: '../CapaNegocio/emitir_ficha.php',
            data:JSON.stringify( {
                selectPaciente: selectPaciente,
                selectEspecialidad: selectEspecialidad,
                selectMedico: idMedico
            }),
            // dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function (xhr, status, error) {
              console.log(xhr.responseText);
                console.error( status, error);
            }
        });
    }

    
</script>

              
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
  
    </section>
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>SEGURO SOCIAL UNIVERSITARO</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
   
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

    
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>