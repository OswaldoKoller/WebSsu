<?php
// Verificar si se recibió el ID del paciente a eliminar
if (isset($_POST['idPaciente'])) {
    $idPaciente = $_POST['idPaciente'];

    // Realizar la conexión a la base de datos
    $conexion = new mysqli("localhost", "admin", "admssu00$$", "ssu");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL para cambiar el estado del paciente
    $consulta = "UPDATE tpaciente SET estado = 0 WHERE id_paciente = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param('i', $idPaciente);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // La eliminación lógica fue exitosa
        echo "Paciente eliminado correctamente";
    } else {
        // Error al ejecutar la consulta
        echo "Error al eliminar el paciente: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else {
    // No se recibió el ID del paciente
    echo "ID del paciente no recibido";
}
?>
