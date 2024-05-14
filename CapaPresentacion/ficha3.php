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
<?php
require_once("../CapaDato/conexion.php");
require_once("../CapaDato/pacienteDAO.php");
require_once("../CapaDato/especialidadDAO.php");
require_once("../CapaDato/medicoDAO.php");
require_once("../CapaDato/fichaDAO.php");

$database = new Database;
$pacienteDAO = new pacienteDAO($database);
$especialidadDAO = new especialidadDAO($database);
$medicoDAO = new medicoDAO($database);
$fichaDAO = new fichaDAO($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $selectPaciente = $_POST["selectPaciente"];
    $selectEspecialidad = $_POST["selectEspecialidad"];
    $selectMedico = $_POST["selectMedico"];
    $fecha_atencion = date("Y-m-d");
    $estado = 1;

    // Llamada a la función insertarFicha de fichaDAO
    $resultado = $fichaDAO->insertarFicha($selectPaciente, $selectEspecialidad, $selectMedico, $fecha_atencion, $estado);

    if ($resultado) {
        // Datos recibidos correctamente
        $response = ["status" => "success", "message" => "Ficha emitida exitosamente."];
    } else {
        // Error al emitir la ficha
        $response = ["status" => "error", "message" => "Error al emitir la ficha."];
    }

    // Establecer la cabecera como JSON
    header('Content-Type: application/json');
    
    // Enviar la respuesta JSON
    echo json_encode($response);
    exit; // Detener la ejecución para evitar la recarga de la página con el mismo formulario
}

// Mostrar los selects de paciente y especialidad
echo '<form method="POST">';
echo '<div class="mb-3">';
echo '<label for="selectPaciente" class="form-label">Seleccione un paciente</label>';
echo '<select class="form-select" id="selectPaciente" name="selectPaciente">';
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
echo '</select>';
echo '</div>';

echo '<div class="mb-3">';
echo '<label for="selectEspecialidad" class="form-label">Seleccione una especialidad</label>';
echo '<select class="form-select" id="selectEspecialidad" name="selectEspecialidad">';
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
echo '</select>';
echo '</div>';

// Obtener la especialidad seleccionada y cargar los médicos
if (isset($_POST["selectEspecialidad"])) {
    $idEspecialidadSeleccionada = $_POST["selectEspecialidad"];
    $medicosEnEspecialidad = $medicoDAO->obtenerMedicosPorEspecialidad($idEspecialidadSeleccionada);

    // Mostrar el select de médicos
    '<div class="mb-3">';
     '<label for="selectMedico" class="form-label">Seleccione un médico</label>';
     '<select class="form-select" id="selectMedico" name="selectMedico">';
    if ($medicosEnEspecialidad !== false) 
        echo '<option value="">Seleccionar</option>';
        foreach ($medicosEnEspecialidad as $medico) {
            $idMedico = $medico['id_medico'];
            $nombreMedico = $medico['nombre'] . ' ' . $medico['apellido'];
            echo '<option value="' . $idMedico . '">' . $nombreMedico . '</option>';
        }
         '</select>';
    } else {
         '<option value="">Error al obtener médicos</option>';
         '</select>';
    }
     '</div>';
}

// Mostrar el botón de enviar
echo '<div class="mb-3">';
echo '<button type="submit" class="btn btn-primary">Enviar</button>';
echo '</div>';
echo '</form>';
?>





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