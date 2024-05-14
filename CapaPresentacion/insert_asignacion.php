<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/usuario.php';
require_once '../CapaNegocio/rol.php';
session_start();

if (!isset($_SESSION['username'])) {
    //header('Location: index.php');
    exit();
}
$db = new database();
$usuario = new Usuario($db);
$rol = new rol();
$mensaje = ""; // Variable para almacenar los mensajes

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarUsuario = $_POST['buscar_usuario'];
    $buscarrol=$_POST['buscar_rol'];

    // Buscar el usuario por el nombre de usuario
    $datosUsuario = $usuario->buscarUsuario($buscarUsuario);
    $datorol= $rol->buscarxnombre($buscarrol);
    if($datosUsuario && $datorol){
        $_SESSION['id_usuarioAsignar']=$datosUsuario['id_usuario'];
        $_SESSION['nombreusuarioAsignar']=$datosUsuario['nombre_usuario'];
        $_SESSION['id_rolAsignar']=$datorol['id_rol'];
        $_SESSION['nombre_rolAsignar']=$datorol['nombre_rol'];
    }
}
        // Realizar la asignación de rol directamente aquí
    
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['asignarRol'])) {

                $idusuarioasignar = $datosUsuario['id_usuario'];
                $id_rolAsignar = $datorol['id_rol'];
                if(!empty($datosUsuario['id_usuario']) && !empty($datorol['id_rol'])) {

                    $resultado =$rol->insertAsignacion($datosUsuario['id_usuario'],$datorol['id_rol']);
                    if($resultado){
                        $mensaje="ASIGNACION CORRECTA";
                        header("Location: asignacion.php");
                
                    }else{
                        $mensaje="ERROR AL ASIGNAR";
                        echo $id_usuarioasignar;
                        echo $id_rolAsignar;
                        header("Location: insert_asignacion.php");
                    }   
                }else{
                    $mensaje="POR FAVOR COMPLETE LOS CAMPOS";
                    echo $id_usuarioasignar;
                        echo $id_rolAsignar;
                    header("Location: insert_asignacion.php");
                }
                
                }
                
            ?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASIGNACION</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
<div class="container">
        
        <h1>ASGINAR ROL-USUARIO</h1>
        
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
                    <div class="form-group">
                        <label>Nombre del rol:</label>
                        <input type="text" name="buscar_rol" class="form-control">
                    </div>
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <?php if (!empty($datosUsuario) && !empty($datorol)): ?>
    <div class="row mt-4">
        <div class="col-md-6">
            <h2>Usuario Encontrado:</h2>
            <table class="table table-bordered">
                <tr>
                    <th>ID Usuario</th>
                    <th>Nombre de Usuario</th>
                </tr>
                <tr>
                    <td><?php echo $datosUsuario['id_usuario']; ?></td>
                    <td><?php echo $datosUsuario['nombre_usuario']; ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Rol Encontrado:</h2>
            <table class="table table-bordered">
                <tr>
                    <th>ID Rol</th>
                    <th>Nombre del Rol</th>
                </tr>
                <tr>
                    <td><?php echo $datorol['id_rol']; ?></td>
                    <td><?php echo $datorol['nombre_rol']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <form method="POST">
                <input type="text" name="nombreusuarioAsignar" value="<?php echo $datosUsuario['id_usuario']; ?>">
                <input type="text" name="nombre_rolAsignar" value="<?php echo $datorol['id_rol']; ?>">
                <button type="submit" name="asignarRol" class="btn btn-success">Asignar Rol</button>
                <button type="submit" class="btn btn-danger" name="test">TEST</button>


            </form>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>