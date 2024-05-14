<?php
require_once("../CapaDato/conexion.php");
require_once("../CapaDato/medicoDAO.php");

if (isset($_GET['id_especialidad'])) {
    $idEspecialidad = $_GET['id_especialidad'];

    // Crear una instancia de Database
    $database = new Database();

    // Crear una instancia de medicoDAO con la instancia de Database
    $medicoDAO = new medicoDAO($database);

    // Obtener médicos por especialidad
    $medicos = $medicoDAO->obtenerMedicosPorEspecialidad($idEspecialidad);

    // Devolver los médicos como JSON
    echo json_encode($medicos);
} else {
    echo json_encode(array('error' => 'Parámetro id_especialidad no proporcionado.'));
}
?>
