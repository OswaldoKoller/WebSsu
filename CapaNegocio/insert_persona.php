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
    $nombre = $_POST["nombre-registro"];
    $apellido = $_POST["apellido-registro"];
    $fecha_nacimiento = $_POST["fechaNacimiento-registro"];
    $telefono = $_POST["telefono-registro"];
    $correo = $_POST["correo-registro"];
    $direccion = $_POST["direccion-registro"];
    $estado = $_POST["estado-registro"];

    $username = $_POST["username-registro"];
    $password = $_POST["password-registro"];
    $userEstado = $_POST["user-estado-registro"];
}
    // Insertar los datos en la base de datos
    $idPersona = $persona->insert('null',$nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $direccion, $estado);

    if ($idPersona != false) {
        $usuarioId = $usuario->insert($idPersona,$username, $password, $userEstado);
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