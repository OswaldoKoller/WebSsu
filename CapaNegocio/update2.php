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
        } else {
            // Hubo un error durante la actualización
            $mensaje = "Error al actualizar los datos del usuario.";
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