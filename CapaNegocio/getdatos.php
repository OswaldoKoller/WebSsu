<?php
require_once "../CapaDato/conexion.php";

$id = $conn->real_escape_string($_POST['id']);
$sql = "SELECT id_persona, nombre, apellido, fecha_nacimiento, telefono, correo, direccion, estado FROM tpersona WHERE id_persona = $id LIMIT 1";
$resultado = $conn->query($sql);
$rows = $resultado->num_rows; // Corregir aquí
$dato = [];

if ($rows > 0) { // Corregir aquí
    $dato = $resultado->fetch_array();
}
echo json_encode($dato, JSON_UNESCAPED_UNICODE);
?>