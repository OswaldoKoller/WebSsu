<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/usuario.php';
require_once '../CapaNegocio/persona.php';
session_start();

if (!isset($_SESSION['username'])) {
    //header('Location: index.php');
    exit();
}
$db = new database();
$usuario = new Usuario($db);
$persona = new Persona($db);
$mensaje = ""; // Variable para almacenar los mensajes

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarUsuario = $_POST['buscar_usuario'];

    // Buscar el usuario por el nombre de usuario
    $datosUsuario = $usuario->buscarUsuario($buscarUsuario);
    $datoPersona = $persona->obtenerDatosPersona($datosUsuario['id_persona']);
    if ($datosUsuario) {
        $_SESSION['usuarioIdBuscar'] = $datosUsuario['id_usuario'];
        $_SESSION['personaIdBuscar'] = $datosUsuario['id_persona'];
        $_SESSION['usernameBuscar']= $datosUsuario['nombre_usuario'];
        $_SESSION['passwordBuscar'] = $datosUsuario['pass_usuario'];
        $_SESSION['nombre_personaBuscar'] = $datoPersona['nombre'];
        $_SESSION['apellido_personaBuscar'] = $datoPersona['apellido'];
        $_SESSION['telefono_personaBuscar'] = $datoPersona['telefono'];
     } else {
        // No se encontró ningún usuario con el nombre especificado
        $mensaje = "No se encontró ningún usuario con el nombre de usuario: $buscarUsuario";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar'])) {
    $usuarioIdActualizar = $_SESSION['usuarioIdBuscar'] ?? '';
    $personaIdActualizar = $_SESSION['personaIdBuscar'] ?? '';
    $usernameActualizar = $_POST['usernameBuscar'] ?? '';
    $passwordActualizar = $_POST['paswordBuscar'] ?? '';
    $nombreActualizar = $_POST['nombre_personaActualizar'];
    $apellidoActulizar = $_POST['apellido_personaActulizar'];
    $telefonoActulizar = $_POST['telefono_personaActulizar'];

    if (!empty($usuarioIdActualizar) && !empty($personaIdActualizar) && !empty($usernameActualizar) && !empty($passwordActualizar)) {
        $resultado = $usuario->update($usernameActualizar, $passwordActualizar, $usuarioIdActualizar);
        if ($resultado) {
            // La actualización fue exitosa
            $mensaje = "Los datos del usuario se han actualizado correctamente.";
            header("Location: ../CapaPresentacion/pages-blank.php");
        } else {
            // Hubo un error durante la actualización
            $mensaje = "Error al actualizar los datos del usuario.";
            header("Location: ../CapaPresentacion/up_perso.php");
        }

        if (!empty($nombreActualizar) && !empty($apellidoActulizar) && !empty($telefonoActulizar)) {
            $resultado_persona = $persona->update($nombreActualizar, $apellidoActulizar, $telefonoActulizar, $personaIdActualizar);
            if ($resultado_persona) {
                // La actualización fue exitosa
                $mensaje = "Los datos de la persona se han actualizado correctamente.";
            } else {
                // Hubo un error durante la actualización
                $mensaje = "Error al actualizar los datos de la persona.";
            }
        } else {
            // No se proporcionaron todos los datos necesarios
            $mensaje = "Por favor, complete todos los campos requeridos.";
        }
    }

}




?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <div class="container">
        
        <h1>Editar Usuario</h1>
        
        <?php if (!empty($mensaje)): ?>
            <div class="alert <?php echo ($resultado) ? 'alert-success' : 'alert-danger'; ?>"><?php echo $mensaje; ?></div>
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
                        
                        <?php if(isset($datoPersona)): ?>
                        <div class="form-group">
                            <label>Nombre:</label>
                            <input type="text" name="nombre_personaActualizar" value="<?php echo $_SESSION['nombre_personaBuscar']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Apellido:</label>
                            <input type="text" name="apellido_personaActulizar" value="<?php echo $_SESSION['apellido_personaBuscar']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telefono:</label>
                            <input type="text" name="telefono_personaActulizar" value="<?php echo $_SESSION['telefono_personaBuscar']; ?>" class="form-control">
                        </div>
                        
                        <?php endif; ?>
                      
                        <div class="form-group">
                            <label>Nombre de Usuario:</label>
                            <input type="text" name="usernameBuscar" value="<?php echo $_SESSION['usernameBuscar']; ?>" class="form-control">
                        </div>
                        <div class="form-group">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="paswordBuscar" id="paswordBuscar" value="<?php echo $_SESSION['passwordBuscar']; ?>" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" id="toggle-password"></i>
                                </span>
                            </div>
                        </div>
                         </div>

                        <script>
                        document.getElementById("toggle-password").addEventListener("click", function() {
                            var passwordInput = document.getElementById("paswordBuscar");
                            if (passwordInput.type === "password") {
                                passwordInput.type = "text";
                            } else {
                                passwordInput.type = "password";
                            }
                        });
                        </script>

                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
</body>
</html>
