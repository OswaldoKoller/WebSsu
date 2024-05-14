<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

require_once "../CapaDato/conexion.php";
require_once "../CapaNegocio/Ficha.php";
require_once "../CapaDato/FichaDAO.php";

$database = new Database();
$fichaDAO = new FichaDAO($database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $j = file_get_contents('php://input');
    $data = json_decode($j);
   
    $selectPaciente = $data->selectPaciente;
    $selectEspecialidad = $data->selectEspecialidad;
    $selectMedico = $data->selectMedico;
    $fecha = date("Y-m-d");
    $estado = 1;

    header('Content-Type: application/json');
    
    // Guardar la ficha en la base de datos
    $result = $fichaDAO->insertarFicha($selectPaciente, $selectEspecialidad, $selectMedico, $fecha, $estado);

    if ($result) {
        $response = array('success' => true, 'message' => 'Ficha emitida correctamente.');
    } else {
        $response = array('success' => false, 'message' => 'Error al emitir la ficha. ' . $database->getConexion()->error);
    }

    // Devolver la respuesta como JSON
    echo json_encode($response);
} else {
    // Manejar el caso en que no se haya enviado un formulario
    $response = array('success' => false, 'message' => 'Error: No se recibieron datos del formulario.');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
