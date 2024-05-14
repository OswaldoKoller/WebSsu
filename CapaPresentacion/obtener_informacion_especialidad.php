<?php
// Requiere el archivo de conexión y la clase especialidadDAO
require_once('../CapaDato/conexion.php');
require_once('../CapaDato/especialidadDAO.php');

// Verificar si se recibió el ID de la especialidad
if (isset($_POST['id_especialidad'])) {
    $id_especialidad = $_POST['id_especialidad'];

    // Crear una instancia de especialidadDAO
    $especialidadDAO = new especialidadDAO(new Database());

    // Llamar a la función busca_especialidad para obtener la información de la especialidad
    $especialidad = $especialidadDAO->busca_especialidad($id_especialidad);

    // Verificar si se encontró la especialidad
    if ($especialidad !== null) {
        // Devolver la información de la especialidad en formato JSON
        echo json_encode($especialidad);
    } else {
        // No se encontró la especialidad
        echo json_encode(['error' => 'Especialidad no encontrada']);
    }
} else {
    // No se recibió el ID de la especialidad
    echo json_encode(['error' => 'ID de especialidad no recibido']);
}
?>
