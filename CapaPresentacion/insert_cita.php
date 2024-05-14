<?php
require_once("../CapaDato/citaMedicaDAO.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idFicha = $_POST['id_ficha'];
    $diagnostico = $_POST['diagnostico'];
    $motivo = $_POST['motivo'];
    $tratamiento = $_POST['tratamiento'];
    $indicaciones = $_POST['indicaciones'];
    $fecha_emision = date('Y-m-d');

   

    require_once("../CapaDato/conexion.php");
    $database = new Database;
    $citaMedicaDAO = new CitaMedicaDAO($database);

    $datosCitaMedica = array(
        'id_ficha' => $idFicha,
        'diagnostico' => $diagnostico,
        'motivo' => $motivo,
        'tratamiento' => $tratamiento,
        'indicacion' => $indicaciones,
        'fecha_emision' => $fecha_emision,
    );

    $resultado = $citaMedicaDAO->insertarCitaMedica($datosCitaMedica);

    if ($resultado) {
        echo '<div id="mensaje" style="display:none;">La consulta se ha guardado correctamente.</div>';
        header("Location: busca_paciente_historial.php");
        exit;
    } else {
        echo '<div id="mensaje" style="display:none;">Error al guardar la consulta.</div>';
        header("Location: busca_paciente_historial.php");
        exit;
    }
} else {
    echo 'Solicitud no válida.';
}
?>
<script>
    var mensajeDiv = document.getElementById('mensaje');
    if (mensajeDiv && mensajeDiv.innerHTML.trim() !== '') {
        alert(mensajeDiv.innerText);
        if (mensajeDiv.innerText.includes('correctamente')) {
            window.location.href = 'busca_paciente_historial.php';
        }
    }
</script>
