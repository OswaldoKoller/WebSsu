<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/especialidad.php'; // Cambiado a la clase de especialidad
require_once '../CapaNegocio/persona.php';
session_start();

if (!isset($_SESSION['username'])) {
    //header('Location: index.php');
    exit();
}

$db = new Database();
$especialidad = new Especialidad($db); // Cambiado a la clase de especialidad
$persona = new Persona($db);
$mensaje = ""; // Variable para almacenar los mensajes

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarEspecialidad = $_POST['buscar_especialidad'];

    // Buscar la especialidad por el nombre
    $datosEspecialidad = $especialidad->buscarEspecialidad($buscarEspecialidad);

    if ($datosEspecialidad) {
        $_SESSION['especialidadIdBuscar'] = $datosEspecialidad['id_especialidad'];
        $_SESSION['nombreEspecialidadBuscar'] = $datosEspecialidad['nombre_especialidad'];
        $_SESSION['estadoEspecialidadBuscar'] = $datosEspecialidad['estado'];
    } else {
        // No se encontró ninguna especialidad con el nombre especificado
        $mensaje = "No se encontró ninguna especialidad con el nombre: $buscarEspecialidad";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $especialidadIdActualizar = $_SESSION['especialidadIdBuscar'] ?? '';
    $nombreEspecialidadActualizar = $_POST['nombreEspecialidadActualizar'];
    $estadoEspecialidadActualizar = $_POST['estadoEspecialidadActualizar'];

    if (!empty($especialidadIdActualizar) && !empty($nombreEspecialidadActualizar)) {
        $resultado = $especialidad->update($nombreEspecialidadActualizar, $estadoEspecialidadActualizar, $especialidadIdActualizar);

        if ($resultado) {
            // La actualización fue exitosa
            $mensaje = "Los datos de la especialidad se han actualizado correctamente.";
            header("Location: ../CapaPresentacion/especialidad.php");
        } else {
            // Hubo un error durante la actualización
            $mensaje = "Error al actualizar los datos de la especialidad.";
            header("Location: ../CapaPresentacion/modificar_especialidad.php");
        }
    } else {
        // No se proporcionaron todos los datos necesarios
        $mensaje = "Por favor, complete todos los campos requeridos.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modificar Especialidad</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">

        <h1>Modificar Especialidad</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert <?php echo ($resultado) ? 'alert-success' : 'alert-danger'; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="form-group">
                        <label>Nombre de la Especialidad:</label>
                        <input type="text" name="buscar_especialidad" class="form-control">
                    </div>
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                </form>
            </div>

            <?php if (isset($datosEspecialidad)): ?>
                <div class="col-md-6">
                    <form method="POST">
                        <input type="hidden" name="especialidad_id" value="<?php echo $_SESSION['especialidadIdBuscar']; ?>">

                        <div class="form-group">
                            <label>Nombre de la Especialidad:</label>
                            <input type="text" name="nombreEspecialidadActualizar" value="<?php echo $_SESSION['nombreEspecialidadBuscar']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Estado:</label>
                            <input type="text" name="estadoEspecialidadActualizar" value="<?php echo $_SESSION['estadoEspecialidadBuscar']; ?>" class="form-control">
                        </div>

                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>
