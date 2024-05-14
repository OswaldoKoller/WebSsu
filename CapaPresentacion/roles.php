<?php
// Inicia la sesión antes de cualquier salida (HTML o espacios en blanco)
session_start();

require_once "../CapaDato/conexion.php";
require_once "../CapaDato/rolDAO.php";
require_once "../CapaNegocio/rol.php";
require_once "../CapaDato/UsuarioDao.php";

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$database = new Database();
$roles = new rol();
$datos = $roles->allrol();
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

  </aside>

  <!-- ======= Sidebar ======= -->
  <main id="main" class="main">

<div class="pagetitle">
  <h1>ADMINISTRACION DE ROL</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
      <li class="breadcrumb-item">ADMINISTRACION DE ROL</li>
      
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-6">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">REGISTRO DE ROLES </h5>
          <p>Control de acceso y seguirdad al sistema: REGISTRO DE ROLES, MODIFICACION, ELIMINACION.</p>
        </div>
      </div>

    </div>

  </div>
  
</section>
                  <!-- *******botones de modal******* -->
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
           REGISTRAR ROL
          </button>
          <a href="update_rol.php" class="btn btn-primary">ACTUALIZAR ROL</a>
          <a href="del_rol.php" class="btn btn-danger">ELIMINAR ROL</a>
            
          
          
          <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">DATOS DEL ROL</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                                    

                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">INGRESE LOS DATOS</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" method="POST" action="../CapaNegocio/insert_rol.php">
                      <div class="col-12">
                        <label for="inputNanme4" class="form-label">NOMBRE DEL ROL :</label>
                        <input type="text" class="form-control" id="nombre_rol" name="nombre_rol">
                      </div>
                      <div class="col-12">
                        <label for="inputNanme4" class="form-label">DESCRIPCION DEL ROL:</label>
                        <input type="text" class="form-control" id="descripcion_rol" name="descripcion_rol">
                      </div>
                      
                      <div class="form-group">
                        <label for="genero">Estado</label>
                        <select class="form-control" id="estado_rol" name="estado_rol">
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

</<section>

        
<div class="card">
        <div class="card-body">
          <h5 class="card-title">Default Table</h5>

          <!-- Default Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID DEL ROL</th>
                <th scope="col">NOMBRE</th>
                <th scope="col">DESCRIPCION</th>
                
              </tr>
            </thead>
            <tbody>
              
            <?php
            foreach ($datos as $datorol){
              ?>
            <tr>

              <td><?php echo $datorol['id_rol']; ?> </td>
              <td><?php echo $datorol['nombre_rol']; ?> </td>
              <td><?php echo $datorol['descripcion_rol']; ?> </td>
              
              
            </tr>
              <?php
                }
              ?> 
              
              
              
            </tbody>

            
          </table>              
          <!-- End Default Table Example -->
        </div>
      </div>
      

       <!-- VENTANA DE ELIMINAR -->
       <div class="modal fade" id="exampleModalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                       <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ELIMINAR PERSONA</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <!-- ELIMINAR -->
                   <div>
                   Desea eliminar a la persona
                  <a href="../CapaNegocio/eliminar_usuario?id=<?php echo $datO['id_persona']; ?>" class="btn btn-primary btn-sm">SI</a>
                  <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>           
      <div class="modal fade" id="fullscreenModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">EDITAR USUARIO</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="container">
    
    <h1>Editar Usuario</h1>
    
    <?php if (!empty($mensaje)): ?>
        <div class="alert <?php echo ($resultado) ? 'alert-success' : 'alert-danger'; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <form method="POST">
                <div class="form-group">
                    <label>Nombre de Usuario:</label>
                    <input type="text" name="buscar_usuario" class="form-control">
                </div>
                <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
            </form>
        </div>

        <?php if (isset($datosUsuario)): ?>
            <div class="col-md-6">
                <form method="post">
                    <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuarioIdBuscar']; ?>">
                    <input type="hidden" name="persona_id" value="<?php echo $_SESSION['personaIdBuscar']; ?>">
                    
                    <?php if(isset($datoPersona)): ?>
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" name="nombre_personaActualizar" value="<?php echo $_SESSION['nombre_personaBuscar']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Apellido:</label>
                        <input type="text" name="apellido_personaActulizar" value="<?php echo $_SESSION['apellido_personaBuscar']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Telefono:</label>
                        <input type="text" name="telefono_personaActulizar" value="<?php echo $_SESSION['telefono_personaBuscar']; ?>" class="form-control">
                    </div>
                    
                    <?php endif; ?>
                  
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="usernameBuscar" value="<?php echo $_SESSION['usernameBuscar']; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                    <label for="password">Password:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="paswordBuscar" id="paswordBuscar" value="<?php echo $_SESSION['passwordBuscar']; ?>" required>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-eye" id="toggle-password"></i>
                            </span>
                        </div>
                    </div>
                     </div>
                    <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
              
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

      


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
  <script>
    // Función para cargar los datos del rol en el formulario
    function cargarDatosEnFormulario(rol) {
        // Llena los campos del formulario con los datos del rol
        document.getElementById("rol_id").value = rol.id;
        document.getElementById("nombre_rol_actualizar").value = rol.nombre;
        document.getElementById("descripcion_rol_actualizar").value = rol.descripcion;
        document.getElementById("estado_rol_actualizar").value = rol.estado;
    }

    // Evento al mostrar el modal
    $('#actualizarRolModal').on('show.bs.modal', function(event) {
        // Obtén el botón que abrió el modal
        var button = $(event.relatedTarget);

        // Obtén los datos del rol desde el atributo "data-rol"
        var rol = button.data('rol');

        // Carga los datos del rol en el formulario
        cargarDatosEnFormulario(rol);
    });
</script>

</body>

</html>