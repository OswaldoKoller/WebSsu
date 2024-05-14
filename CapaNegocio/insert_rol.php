<?php
require_once "../CapaDato/rolDAO.php";
require_once "../CapaDato/conexion.php";

$mensaje = "";
$alertClass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_rol = $_POST["nombre_rol"];
    $descripcion_rol = $_POST["descripcion_rol"];
    $estado_rol = $_POST["estado_rol"];

    // Validación de campos no vacíos y sin caracteres extraños
    if (!empty($nombre_rol) && !empty($descripcion_rol) && preg_match('/^[a-zA-Z0-9\s]+$/', $nombre_rol) && preg_match('/^[a-zA-Z0-9\s]+$/', $descripcion_rol) && !empty($estado_rol)) {

        $database = new Database();
        $rolDAO = new RolDAO($database);

        if ($rolDAO->insert($nombre_rol, $descripcion_rol, $estado_rol)) {
            $mensaje = "Rol creado exitosamente.";
            $alertClass = "success";
            header("Location: ../CapaPresentacion/roles.php");
            
            
        } else {
            $mensaje = "Error al crear el rol.";
            $alertClass = "danger";
            
        }
    } else {
        $mensaje = "Por favor, ingrese información válida en todos los campos.";
        $alertClass = "danger";
    }
}
?>
 