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
      <h1>ADMINISTRAR ESPECIALIDAD</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">ADMINISTRAR ESPECIALIDAD</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">REGISTRO DE ESPECIALIDAD</h5>
              <p>CREACION DE ESPECIALIDAD PARA LOS MEDICOS .</p>
            </div>
          </div>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                REGISTRAR ESPECIALIDAD
              </button>
              <a href="modificar_especialidad.php"class="btn btn-primary btn-sm">MODIFICAR ESPECIALIDAD</a>
              
              <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">DATOS</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                        

                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">NUEVA ESPECIALIDAD</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" method="POST" action="../CapaNegocio/insert_especialidad.php">
                          <div class="col-12">
                            <label for="inputNanme4" class="form-label">NOMBRE ESPECIALIDAD :</label>
                            <input type="text" class="form-control" id="nombre_especilidad" name="nombre_especialidad">
                          </div>
                          
                          <div class="form-group">
                            <label for="genero">Estado</label>
                            <select class="form-control" id="estado_especialidad" name="estado_especialidad">
                              <option value="">Seleccione el estado</option>
                              <option value="1">Activo</option>
                              <option value="0">Baja</option>
                            </select>
                          </div>

                          
                        
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                          </div>
                        </form><!-- Vertical Form -->                     
</div>
                    
                      <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>
</div>
        
      </div>
      <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>

              <!-- Default Table -->
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">ID_ ESPECIALIDAD</th>
                      <th scope="col">ESPECIALIDAD</th>
                      <th scope="col">ACCION</th>
                      
                      
                     
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($tespecialidad as $especialidad) : ?>
                    <tr>
                        <td><?php echo $especialidad['id_especialidad']; ?></td>
                        <td><?php echo $especialidad['nombre_especialidad']; ?></td>
                        <td>
                         <button type="button" class="btn btn-danger btn-sm btn-eliminar" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" data-id="<?php echo $especialidad['id_especialidad']; ?>">ELIMINAR</button>
                         </td>
                    </tr>
                        <?php endforeach; ?>
                  </tbody>
                  
              </table>  
              <div class="modal fade" id="agregarEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Especialidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí puedes colocar los campos para agregar una nueva especialidad -->
        <!-- Por ejemplo, un campo para el nombre de la especialidad -->
        <div class="form-group">
          <label for="nombreEspecialidad">Nombre de la Especialidad</label>
          <input type="text" class="form-control" id="nombreEspecialidad" placeholder="Ingrese el nombre de la especialidad">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <!-- Aquí puedes colocar un botón para guardar la nueva especialidad -->
        <button type="button" class="btn btn-primary" id="guardarEspecialidad">Guardar</button>
      </div>
    </div>
  </div>
</div>           
            </div>
    </div>
    </section>








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
        <script>
    $(document).ready(function() {
        // Captura del clic en el botón "Eliminar"
        $('.btn-eliminar').click(function() {
            var idEspecialidad = $(this).data('id');
            // Abre el modal de confirmación
            $('#btn-confirmar-eliminar').data('id', idEspecialidad);
        });

        // Captura del clic en el botón "Confirmar Eliminar" dentro del modal de confirmación
        $('#btn-confirmar-eliminar').click(function() {
            // Obtiene el ID de la especialidad a eliminar desde el botón de confirmar eliminar
            var idEspecialidad = $(this).data('id');

            // Envía una solicitud AJAX para eliminar la especialidad con el ID
            $.ajax({
                type: 'POST',
                url: 'eliminar_especialidad.php',  // Nombre del archivo PHP que manejará la eliminación
                data: { idEspecialidad: idEspecialidad },
                success: function(response) {
                    // Puedes manejar la respuesta del servidor aquí (por ejemplo, recargar la página)
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Error al eliminar la especialidad: ' + error);
                }
            });
        });
    });
</script>






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