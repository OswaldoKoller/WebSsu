<?php
require_once('../CapaDato/especialidadDAO.php');

// Verificar si se recibió el ID de la especialidad a eliminar
if (isset($_POST['idEspecialidad'])) {
    $idEspecialidad = $_POST['idEspecialidad'];

    // Crear una instancia de especialidadDAO
    $especialidadDAO = new especialidadDAO(new Database());

    // Realizar la eliminación lógica
    if ($especialidadDAO->softDelete($idEspecialidad)) {
        // La eliminación lógica fue exitosa
        echo "Especialidad eliminada correctamente";
    } else {
        // Error en la eliminación lógica
        echo "Error al eliminar la especialidad";
    }
} else {
    // No se recibió el ID de la especialidad
    echo "ID de la especialidad no recibido";
}
?>
