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

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>ADMINISTRAR USUARIO</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="page.php">Home</a></li>
          <li class="breadcrumb-item">ADMINISTRAR USUARIO</li>
          
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ADMINISTRAR USUARIO</h5>
              <p>Control de acceso y seguiridad al sistema: REGISTRO, MODIFICACION, ELIMINACION.</p>
            </div>
          </div>

        </div>

      </div>
    </section>
                      <!-- *******botones de modal******* -->
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                REGISTRAR USUARIO
              </button>
           <!--  <a href="up_perso.php" class="btn btn-primary">ACTUALIZAR USUARIO</a>
             <a href="del_per.php" class="btn btn-danger">ELIMINAR USUARIO</a>-->
             <style>
             label {
      font-weight: bold;
    }

    select {
      padding: 8px;
      margin-top: 5px;
    }
             </style>
             <label for="selectOpciones">BUSCAR PERSONA :</label>
  <select id="selectOpciones" onchange="redireccionar()">
    
    <option value="up_perso.php">Modificar</option>
    <option value="del_per.php">Eliminar</option>
  </select>

  <script>
    function redireccionar() {
      var select = document.getElementById("selectOpciones");
      var opcionSeleccionada = select.options[select.selectedIndex].value;

      // Redirige a la página seleccionada
      if (opcionSeleccionada !== "") {
        window.location.href = opcionSeleccionada;
      }
    }
  </script> 
              <div class="modal fade" id="modalDialogScrollable" tabindex="-1">
                <div class="modal-dialog modal-dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">REGISTRO DE USUARIO</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                        

                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">INGRESE SUS DATOS PERSONALES</h5>

                          <!-- Vertical Form -->
                          <form class="row g-3" method="POST" action="../CapaNegocio/insert_persona.php">
                            <div class="col-12">
                              <label for="inputNanme4" class="form-label">NOMBRE :</label>
                              <input type="text" class="form-control" id="nombre-registro" name="nombre-registro">
                            </div>
                            <div class="col-12">
                              <label for="inputNanme4" class="form-label">APELLIDO :</label>
                              <input type="text" class="form-control" id="apellido-registro" name="apellido-registro">
                            </div>
                            <div class="col-12">
                              <label for="inputNanme4" class="form-label">FECHA DE NACIMIENTO :</label>
                              <input type="date" class="form-control" id="fechaNacimiento-registro" name="fechaNacimiento-registro">
                            </div>
                            <div class="col-12">
                              <label for="inputNanme4" class="form-label">TELEFONO :</label>
                              <input type="number" class="form-control" id="telefono-registro" name="telefono-registro">
                            </div>
                            <div class="col-12">
                              <label for="inputEmail4" class="form-label">CORREO</label>
                              <input type="email" class="form-control" id="correo-registro" name="correo-registro">
                            </div>
                            <div class="col-12">
                              <label for="inputAddress" class="form-label">Address</label>
                              <input type="text" class="form-control" id="direccion-registro" name="direccion-registro" placeholder="1234 Main St">
                            </div>
                            <div class="form-group">
                              <label for="genero">Estado</label>
                              <select class="form-control" id="estado-registro" name="estado-registro">
                                <option value="">Seleccione el estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Baja</option>
                              </select>
                            </div>

                            <h5 class="card-title">INGRESE SUS DATOS DE USUARIO</h5>
                            <div class="col-12">
                              <label for="inputAddress" class="form-label">USUARIO</label>
                              <input type="text" class="form-control" id="username-registro" name="username-registro" placeholder="Ingrese su nombre de usuario">
                            </div>
                            <div class="col-12">
                              <label for="inputPassword4" class="form-label">Password</label>
                              <input type="password" class="form-control" id="password-registro" name="password-registro">
                            </div>
                            <div class="form-group">
                              <label for="genero">Estado</label>
                              <select class="form-control" id="user-estado-registro" name="user-estado-registro">
                                <option value="">Seleccione el estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Baja</option>
                              </select>
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Registrar</button>
                            
                            </div>
                            <script>
                document.addEventListener('DOMContentLoaded', function () {
                const form = document.querySelector('form');

                form.addEventListener('submit', function (event) {
                  // Validar que los campos no estén vacíos
                  const inputs = form.querySelectorAll('input, select');
                  let isValid = true;

                  inputs.forEach(input => {
                    if (input.value.trim() === '') {
                      isValid = false;
                      alert('Todos los campos son obligatorios. Por favor, complete todos los campos.');
                      event.preventDefault();
                    }
                  });

                  if (!isValid) {
                    return;
                  }

                  // Validar que el nombre de usuario y contraseña no contengan caracteres especiales para prevenir ataques SQL
                  const username = document.getElementById('username-registro').value;
                  const password = document.getElementById('password-registro').value;

                  if (/[\W_]/.test(username) || /[\W_]/.test(password)) {
                    alert('El nombre de usuario y la contraseña no deben contener caracteres especiales.');
                    event.preventDefault();
                  }

                  // Aquí puedes agregar más validaciones según tus requisitos

    });
  });
</script>
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
  
    <!-- ******tabla que muestra los datos*****          -->
    <div class="card">
            <div class="card-body">
              

              <!-- Default Table -->
              <table class="table">
                <br>
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">NOMBRE</th>
                      <th scope="col">APELLIDO</th>
                      <th scope="col">TELEFONO</th>
                      <th scope="col">DIRECCION</th>
                     
                      <th scope="col">NOMBRE DE USUARIO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datos as $dato){
                      ?>
                    <tr>
                      <td><?php echo $dato['id_persona']; ?> </td>
                      <td><?php echo $dato['nombre']; ?> </td>
                      <td><?php echo $dato['apellido']; ?> </td>
                      <td><?php echo $dato['telefono']; ?> </td>
                      <td><?php echo $dato['direccion']; ?> </td>
                     
                      <td><?php echo $dato['nombre_usuario']; ?> </td>
                    </tr>
                      <?php
                        }
                      ?> 
                  </tbody>
                  
              </table>              
            </div>
    </div>
    <!-- VENTANA DE ELIMINAR -->
    
    <!-- fin de tabla -->
              
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