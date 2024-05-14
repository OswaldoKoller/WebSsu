<?php
require_once '../CapaNegocio/usuario.php';
require_once '../CapaNegocio/persona.php';

if(isset($_POST['id_persona']) && !empty($_POST['id_persona'])) {
    $id_persona = $_POST['id_persona'];
    $persona = new persona();
    $persona->eliminar($id_persona);
}

// Redireccionar a la página principal o a la lista de usuarios
header("Location: ../CapaPresentacion/pages-blank.php");
exit();
?>