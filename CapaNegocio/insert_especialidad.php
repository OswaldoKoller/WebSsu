<?php
require_once 'especialidad.php';
require_once '../CapaDato/conexion.php';

session_start();

$db = new database();
$esp = new especialidad();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_es = $_POST['nombre_especialidad'];
    $estado = $_POST['estado_especialidad'];
    

    $id_espe = $esp->insert($nom_es, $estado);

    if ($id_espe != false) {
        $_SESSION["success_message"] = "Datos registrados correctamente";
        header('Location: ../CapaPresentacion/especialidad.php');
        exit();
    } else {
        $error_message = "Error al registrar";
    }
}
?>

<?php if (isset($_SESSION["success_message"])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION["success_message"]; ?>
    </div>
    <?php unset($_SESSION["success_message"]); ?>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error_message; ?>
    </div>
<?php endif; ?>

<?php
if (isset($_GET["success"])) {
    echo '<div class="alert alert-success mt-3">Usuario agregado correctamente...!!!</div>';
}
if (isset($_GET["error"])) {
    echo '<div class="alert alert-danger mt-3">Fallo al agregar usuario!!!.</div>';
}
?>
