<?php
require_once '../CapaDato/conexion.php';
require_once '../CapaNegocio/rol.php';

session_start();
if (!isset($_SESSION['username'])) {
    //header('Location: index.php');
    exit();
}
$db = new database();
$dr = new rol();
$mensaje = ""; // Variable para almacenar los mensajes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar'])) {
    $buscarrol = $_POST['nombre_rol'];
    $datosrol = $dr->buscarxnombre($buscarrol);
    if($datosrol){
        $_SESSION['id_rol_up']=$datosrol['id_rol'];
        $_SESSION['nombre_rol_up']=$datosrol['nombre_rol'];
        $_SESSION['descripcion_rol_up']=$datosrol['descripcion_rol'];
    }else{
        $mensaje= "No se encontró el rol";
    }
}

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['actualizar'])){
    $idrolActualizar=$_SESSION['id_rol_up'];
    $nombre_rolActualizar = $_POST['nombre_rol_up'];
    $descripcion_rolActualizar=$_POST['descripcion_rol_up']; 

    if(!empty($idrolActualizar) && !empty($nombre_rolActualizar) && !empty($descripcion_rolActualizar)){
        $resultadoActualizacion = $dr->update_rol($nombre_rolActualizar, $descripcion_rolActualizar,$idrolActualizar);
        if($resultadoActualizacion){
            $mensaje= "Actualización correcta";
            header("Location: roles.php");
        }else{
            $mensaje="Actualización incorrecta";
            header("Location: update_rol.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Editar Rol</h1>
        
        <?php if (!empty($mensaje)): ?>
            <div class="alert <?php echo ($resultadoActualizacion) ? 'alert-success' : 'alert-danger'; ?>"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="form-group">
                        <label>Nombre de Rol:</label>
                        <input type="text" name="nombre_rol" class="form-control">
                    </div>
                    <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                </form>
            </div>

            <?php if (isset($datosrol)): ?>
                <div class="col-md-6">
                    <form method="POST">
                        <input type="hidden" name="id_rol_up" value="<?php echo $_SESSION['id_rol_up']; ?>" />
                        <div class="form-group">
                            <label>Nombre de Rol:</label>
                            <input type="text" name="nombre_rol_up" value="<?php echo $_SESSION['nombre_rol_up']; ?>"class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Descripción:</label>
                            <input type="text" name="descripcion_rol_up" value="<?php echo $_SESSION['descripcion_rol_up']; ?>" class="form-control">
                        </div>
                        <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
