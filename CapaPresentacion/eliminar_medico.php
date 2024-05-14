<?php
// Verificar si se recibió el ID del médico a eliminar
if (isset($_POST['idMedico'])) {
    $idMedico = $_POST['idMedico'];

    // Realizar la conexión a la base de datos
    $conexion = new mysqli("localhost", "admin", "admssu00$$", "ssu");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para eliminar el médico
    $consulta = "UPDATE tmedico SET estado = 0 WHERE id_medico = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param('i', $idMedico);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // La eliminación fue exitosa
        echo "Médico eliminado correctamente";
    } else {
        // Error al ejecutar la consulta
        echo "Error al eliminar el médico: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else {
    // No se recibió el ID del médico
    echo "ID del médico no recibido";
}
?>