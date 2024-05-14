<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el valor seleccionado del menú desplegable
    $nombreSeleccionado = $_POST["nombre_usuario"];

    // Verifica que se haya seleccionado un usuario
    if (!empty($nombreSeleccionado)) {
        // Realiza la conexión a la base de datos (debes configurar tus propios valores)
        $conexion = mysqli_connect("localhost", "admin", "admssu00$$", "ssu");

        // Verifica si la conexión fue exitosa
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta SQL para obtener el ID de persona basado en el nombre seleccionado
        $consulta = "SELECT id_persona FROM tpersona WHERE nombre = '$nombreSeleccionado'";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $idPersona = $fila["id_persona"];

            // Consulta SQL para insertar el ID de persona en la tabla tmedico
            $consultaMedico = "INSERT INTO tmedico (id_persona, estado) VALUES ($idPersona, 1)";

            if (mysqli_query($conexion, $consultaMedico)) {
                echo "Médico asignado correctamente a la persona.";
                header("Location: medicos.php");
            } else {
                echo "Error al asignar médico: " . mysqli_error($conexion);
                header("Location: medicos.php");
            }

            // Liberar el resultado de la consulta
            mysqli_free_result($resultado);
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Por favor, seleccione una persona antes de asignar un médico.";
    }
} else {
    echo "Acceso no válido.";
}
?>
