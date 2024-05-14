<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/usuario.php';
require_once '../CapaNegocio/persona.php';
require_once '../CapaNegocio/paciente.php';
session_start();

if (!isset($_SESSION['username'])) {
    // Redireccionar a la página de inicio de sesión si el usuario no está autenticado
    header('Location: index.php');
    exit();
}


$database = new Database();
$persona = new persona();
$usuario = new usuario($database);
$paciente = new paciente ();
$datosPaciente=$paciente->tpacientes();
$usuarios = $usuario->obtenerusuario($database);
$personas = $persona->obtenerTodasLasPersonas();
$datos = $usuario->obtenerdatospersonausuarios();
//$datosUsuario = $database->obtenerDatosUsuario($username);
$username = $_SESSION['username']; // Variable para almacenar los mensajes

// Obtener datos de todos los usuarios
$database = new Database();
$personaObj = new Persona();
$usuarioObj = new Usuario($database);
$usuarios = $usuarioObj->obtenerusuario($database);
$personas = $personaObj->obtenerTodasLasPersonas();

// Buscar usuario y datos de persona
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarUsuario = $_POST['buscar_usuario'];

    // Buscar el usuario por el nombre de usuario
    $datosUsuario = $usuarioObj->buscarUsuario($buscarUsuario);
    $datoPersona = $personaObj->obtenerDatosPersona($datosUsuario['id_persona']);
    if ($datosUsuario) {
        $_SESSION['usuarioIdBuscar'] = $datosUsuario['id_usuario'];
        $_SESSION['personaIdBuscar'] = $datosUsuario['id_persona'];
        $_SESSION['usernameBuscar'] = $datosUsuario['nombre_usuario'];
        $_SESSION['passwordBuscar'] = $datosUsuario['pass_usuario'];
        $_SESSION['nombre_personaBuscar'] = $datoPersona['nombre'];
        $_SESSION['apellido_personaBuscar'] = $datoPersona['apellido'];
        $_SESSION['telefono_personaBuscar'] = $datoPersona['telefono'];
    } else {
        // No se encontró ningún usuario con el nombre especificado
        $mensaje = "No se encontró ningún usuario con el nombre de usuario: $buscarUsuario";
    }
}

// Modificar paciente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modificar'])) {
    $id_personaPaciente = $_SESSION['personaIdBuscar'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];

    // Actualizar datos en la tabla tpersona
    $resultadoPersona = $personaObj->actualizarDatosPersona($id_personaPaciente, $nombre, $apellido, $telefono);

    if ($resultadoPersona) {
        // La actualización de datos de persona fue exitosa
        $mensaje = "Datos de persona actualizados correctamente.";
    } else {
        // Error al actualizar datos de persona
        $mensaje = "Error al actualizar datos de persona.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Modificar Paciente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container">
        <h1>Modificar Paciente</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo ($resultadoPersona) ? 'success' : 'danger'; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="form-group">
                        <label>Nombre de Usuario:</label>
                        <input type="text" name="buscar_usuario" class="form-control">
                    </div>
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                </form>
            </div>
                
            <?php if (isset($datosUsuario)): ?>
                <div class="col-md-6">
                    <form method="POST">
                        <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['usuarioIdBuscar']; ?>">
                        <input type="hidden" name="persona_id" value="<?php echo $_SESSION['personaIdBuscar']; ?>">
                        <div class="form-group">
                            <label>Nombre de Usuario:</label>
                            <input type="text" name="usernameBuscar" value="<?php echo $_SESSION['usernameBuscar']; ?>" class="form-control" readonly>
                        </div>

                        <!-- Campos relacionados con la persona -->
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre" value="<?php echo $_SESSION['nombre_personaBuscar']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" name="apellido" value="<?php echo $_SESSION['apellido_personaBuscar']; ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono:</label>
                            <input type="text" name="telefono" value="<?php echo $_SESSION['telefono_personaBuscar']; ?>" class="form-control">
                        </div>

                        <button type="submit" name="modificar" class="btn btn-primary">Modificar Paciente</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="container mt-4">
        <h2>Tabla de Pacientes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Paciente</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha Creación</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach ($datosPaciente as $paciente) {
                    echo "<tr>";
                    echo "<td>" . $paciente['id_paciente'] . "</td>";
                    echo "<td>" . $paciente['nombre'] . "</td>";
                    echo "<td>" . $paciente['apellido'] . "</td>";
                    echo "<td>" . $paciente['fecha_creacion'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
