<?php
require_once '../CapaDato/conexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Validación básica para asegurar que los campos no estén vacíos
    if (empty($usuario) || empty($password)) {
        echo '<div class="alert alert-danger" role="alert">Por favor, ingrese tanto el nombre de usuario como la contraseña.</div>';
        header("Location: ../CPresentacion/login.php");
        exit();
    }

    $database = new Database();
    $loggedIn = $database->login($usuario, $password);

    if ($loggedIn) {
        // Inicio de sesión exitoso
        $_SESSION["username"] = $usuario;
        $message = '<div class="alert alert-success" role="alert" style="background-color: #d4edda; border-color: #c3e6cb; color: #155724;">Inicio de sesión exitoso</div>';
        header("Location: ../CapaPresentacion/index.php");
        exit();
    } else {
        // Inicio de sesión fallido
        $message = '<div class="alert alert-danger" role="alert" style="background-color: #f8d7da; border-color: #f5c6cb; color: #721c24;">Nombre de usuario o contraseña incorrectos. Intente nuevamente.</div>';
       
        header("Location: ../CapaPresentacion/login.php");
        exit();
    }

}
echo $message;
?>