<?php
session_start();

// Destruye todas las variables de sesión
$_SESSION = array();

// Borra la cookie de sesión
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Finaliza la sesión
session_destroy();

// Redirige a la página de inicio de sesión u otra página de tu elección
header("Location: login.php");
exit();
?>