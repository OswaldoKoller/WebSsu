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

$db = new database();
$usuario = new Usuario($db);
$persona = new Persona($db);
$paciente = new paciente();
$mensaje = ""; // Variable para almacenar los mensajes


$database = new Database();
$persona = new persona();
$usuario = new usuario($database);
$usuarios = $usuario->obtenerusuario($database);
$personas = $persona->obtenerTodasLasPersonas();
$datos = $usuario->obtenerdatospersonausuarios();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarUsuario = $_POST['buscar_usuario'];

    // Buscar el usuario por el nombre de usuario
    $datosUsuario = $usuario->buscarUsuario($buscarUsuario);
    $datoPersona = $persona->obtenerDatosPersona($datosUsuario['id_persona']);
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['insertar'])) {
    $id_personaPaciente = $_SESSION['personaIdBuscar'];
    $fecha_creacion = date('Y-m-d'); // Obtener la fecha actual

    if (!empty($id_personaPaciente)) {
        $resultado = $paciente->insert($id_personaPaciente, $fecha_creacion);
        if ($resultado) {
            // La inserción fue exitosa
            $mensaje = "El paciente se ha agregado correctamente.";
            header("Location: ../CapaPresentacion/paciente.php");
            exit(); // Importante salir del script después de la redirección
        } else {
            // Hubo un error durante la inserción
            $mensaje = "Error al agregar el paciente.";
        }
    } else {
        // No se proporcionó el id_persona del paciente
        $mensaje = "Por favor, complete todos los campos requeridos.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Paciente</h1>

        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo ($resultado) ? 'success' : 'danger'; ?>"><?php echo $mensaje; ?></div>
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
                        

                        <!-- Resto de los campos relacionados con la persona -->

                        <button type="submit" name="insertar" class="btn btn-primary">Agregar Paciente</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Default Table</h5>

              <!-- Default Table -->
              <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">NOMBRE</th>
                      <th scope="col">APELLIDO</th>
                     
                      <th scope="col">COD.USER</th>
                      <th scope="col">NOMBRE DE USUARIO</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($datos as $dato){
                      ?>
                    <tr>
                      <td><?php echo $dato['id_persona']; ?> </td>
                      <td><?php echo $dato['nombre']; ?> </td>
                      <td><?php echo $dato['apellido']; ?> </td>
                      
                      <td><?php echo $dato['id_usuario']; ?> </td>
                      <td><?php echo $dato['nombre_usuario']; ?> </td>
                    </tr>
                      <?php
                        }
                      ?> 
                  </tbody>
                  
              </table>              
            </div>
    </div>
    
</body>
</html>
