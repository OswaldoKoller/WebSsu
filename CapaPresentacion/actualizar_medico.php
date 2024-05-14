<?php
require_once("../CapaNegocio/medico.php");

$medico = new medico();
if (isset($_GET['id'])) {
    // Obtener el ID del médico desde la URL
    $idMedico = $_GET['id'];

    // Aquí puedes realizar una consulta a tu base de datos para obtener los datos del médico
    // Supongamos que tienes una función llamada obtenerDatosMedico($idMedico) que obtiene los datos del médico
    // Reemplaza esto con tu código real para obtener los datos del médico
    $datosMedico = $medico->busqueda($idMedico);

    if ($datosMedico) {
        // Los datos del médico se han obtenido correctamente
        $id_medico = $datosMedico[0]['id_medico'];
        $id_usuario = $datosMedico[0]['id_usuario'];
        $nombreUsuario = $datosMedico[0]['nombre_usuario'];
        $estado = $datosMedico[0]['estado'];
    } else {
        // El médico no existe o no se pudo obtener
        echo "El médico no se encontró.";
    }
} else {
    // No se proporcionó un ID de médico en la URL
    echo "No se proporcionó un ID de médico válido.";
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
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">DETALLES DEL MÉDICO</h5>
            <!-- Default Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID_MEDICO</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">APELLIDO</th>
                        <th scope="col">ID_USUARIO</th>
                        <th scope="col">USUARIO</th>
                        <th scope="col">ESTADO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $id_medico ;?> </td>
                        
                        <td><?php echo $id_usuario; ?> </td>
                        <td><?php echo $nombreUsuario; ?> </td>
                        <td><?php echo $estado; ?> </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
                MODIFICAR MEDICO
                 </button>
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
                        <form class="row g-3" method="POST" action="#">
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
        $consulta = "SELECT nombre_usuario FROM tusuario";
        $resultado = mysqli_query($conexion, $consulta);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Recorrer los resultados y crear opciones para el select
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $nombreUsuario = $fila["nombre_usuario"];
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
                          
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary">ASIGNAR</button>
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
