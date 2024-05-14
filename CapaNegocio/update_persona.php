<?php
require_once "Persona.php";
require_once "Usuario.php";
require_once "../CapaDato/conexion.php";

session_start();

$db = new Database();

$persona = new Persona($db); // Asegúrate de pasar la instancia de Database al constructor

//$usuario = new Usuario($db); // Asegúrate de pasar la instancia de Database al constructor
$usuario = new Usuario($db); // Asegúrate de pasar la inst
// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_persona=$_POST['id_persona_update'];
    $nombre = $_POST["nombre_persona-update"];
    $apellido = $_POST["apellido_persona_update"];
    $telefono = $_POST["telefono-registro"];
    $id_usuario= $_POST["id_usuario"];
    $username = $_POST["username_usuario_update"];
    $password = $_POST["password_usuario_update"];
}
    // Insertar los datos en la base de datos
    $persona->update($nombre, $apellido, $telefono);

    if ($idPersona != false) {
        $usuarioId = $usuario->update($idPersona,$username, $password, $userEstado);
        $_SESSION["success_message"] = "Datos registrados correctamente";
        $success_message = $_SESSION["success_message"];
        header('Location: ../CapaPresentacion/pages-blank.php');
        exit();
    } else {
        $error_message = "Error al registrar los datos de la persona";
    }
    ?>
    
    <!-- Mostrar el mensaje de éxito en un div con Bootstrap -->
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <?php echo $success_message; ?>
        </div>
    <?php endif; ?>
<!-- After the <h2> tag -->
<?php
if (isset($_GET["success"])) {
    echo '<div class="alert alert-success mt-3">Usuario agregado correctamente...!!!</div>';
}
if (isset($_GET["error"])) {
    echo '<div class="alert alert-danger mt-3">Fallo al agregar usuario!!!.</div>';
}
?>