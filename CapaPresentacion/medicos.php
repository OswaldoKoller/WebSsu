<?php
require_once "../CapaDato/conexion.php";
require_once "../CapaNegocio/Usuario.php";
require_once "../CapaNegocio/persona.php";
require_once "../CapaNegocio/medico.php";
require_once "../CapaDato/UsuarioDao.php";
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

$database = new Database();
$persona = new persona();
$usuario = new usuario($database);
$usuarios = $usuario->obtenerusuario($database);
$personas = $persona->obtenerTodasLasPersonas();
$datos = $usuario->obtenerdatospersonausuarios();
$medicos = new medico();
$datosMedicos= $medicos->mostrartodos();
$datosUsuario = $database->obtenerDatosUsuario($username);
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
      <h1>ADMINISTRACION DE MEDICO</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">ADMINISTRACION DE MEDICO</li>
         
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">REGISTRO DE MEDICO</h5>
              <p>Control de acceso y seguirdad al sistema: REGISTRO, MODIFICACION, ELIMINACION.</p>
            </div>
          </div>
          
        </div>

      </div>
      <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">REGISTRAR MEDICO</button>

                 <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">DATOS PERSONALES</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                        

                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">INGRESE SUS DATOS PERSONALES</h5>

                        <!-- Vertical Form -->
                        <form class="row g-3" method="POST" action="asigna_medico.php">
                          <div class="col-12">
                          <label for="nombre_usuario">Seleccione el usuario:</label>
                    <select class="form-control" id="nombre_usuario" name="nombre_usuario">
                      <option value="">Seleccione el usuario</option>
                      <?php
                      // Realizar la conexión a la base de datos (debes configurar tus propios valores)
                      $conexion = mysqli_connect("localhost", "admin", "admssu00$$", "ssu");

                      // Verificar si la conexión fue exitosa
                      if (!$conexion) {
                          die("Error de conexión: " . mysqli_connect_error());
                      }

                      // Realizar la consulta SQL para obtener los nombres de usuario
                      $consulta = "SELECT nombre FROM tpersona";
                      $resultado = mysqli_query($conexion, $consulta);

                      // Verificar si la consulta fue exitosa
                      if ($resultado) {
                          // Recorrer los resultados y crear opciones para el select
                          while ($fila = mysqli_fetch_assoc($resultado)) {
                              $nombreUsuario = $fila["nombre"];
                              echo "<option value='$nombreUsuario'>$nombreUsuario</option>";
                          }

                          // Liberar el resultado de la consulta
                          mysqli_free_result($resultado);
                      } else {
                          echo "Error en la consulta: " . mysqli_error($conexion);
                      }

                      // Cerrar la conexión a la base de datos
                      mysqli_close($conexion);
                      ?>
                      
                  </select>
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
                          
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">REGISTRAR MEDICO</button>
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
    </section>
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">TABLA DE MEDICOS</h5>

              <!-- Default Table -->
              <table class="table">
    <thead>
        <tr>
            <th scope="col">ID_MEDICO</th>
            <th scope="col">ID_USUARIO</th>
            <th scope="col">USUARIO</th>
            <th scope="col">ACCION</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($datosMedicos as $dato) {
            ?>
            <tr>
                <td><?php echo $dato['id_medico']; ?> </td>
                <td><?php echo $dato['nombre']; ?> </td>
                <td><?php echo $dato['apellido']; ?> </td>
                <td>
                <button type="button" class="btn btn-danger btn-sm btn-eliminar" data-bs-toggle="modal" data-bs-target="#confirmarEliminarModal" data-id="<?php echo $dato['id_medico']; ?>">ELIMINAR</button>
                <a href="up_perso.php" class="btn btn-primary btn-sm">MODIFICAR</a>
  
              </td>
            </tr>
            <?php
        }
        ?> 
        
    </tbody>
</table>


</main>

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
  



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    // Captura del clic en el botón "Eliminar"
    $('.btn-eliminar').click(function() {
        var idMedico = $(this).data('id');
        // Abre el modal de confirmación
        $('#btn-confirmar-eliminar').data('id', idMedico);
    });

    // Captura del clic en el botón "Confirmar Eliminar" dentro del modal de confirmación
    $('#btn-confirmar-eliminar').click(function() {
        // Obtiene el ID del médico a eliminar desde el botón de confirmar eliminar
        var idMedico = $(this).data('id');

        // Envía una solicitud AJAX para eliminar el médico con el ID
        $.ajax({
            type: 'POST',
            url: 'eliminar_medico.php',  // Nombre del archivo PHP que manejará la eliminación
            data: { idMedico: idMedico },
            success: function(response) {
                // Puedes manejar la respuesta del servidor aquí (por ejemplo, recargar la página)
                window.location.reload();
            },
            error: function(error) {
                console.error('Error al eliminar el médico: ' + error);
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
     integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
 integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<!-- Modal de Confirmación para Eliminar -->
<div class="modal fade" id="confirmarEliminarModal" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmarEliminarModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro de que deseas eliminar este médico?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn-confirmar-eliminar">Confirmar Eliminar</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>