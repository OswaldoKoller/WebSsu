<?php
require_once '../CapaNegocio/medico.php';

if (isset($_GET['id_medico']) && !empty($_GET['id_medico'])) {
    $id_medico = $_GET['id_medico'];
    $nmedico = new medico();
    $nmedico->delete($id_medico);
    header("Location: medicos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eliminar medico</title>
</head>
<body>
<div class="modal fade" id="exampleModalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ELIMINAR USUARIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="del_medico.php">
                    ¿DESEA ELIMINAR EL REGISTRO?
                    <br><br>
                    Una vez eliminado no se podrá recuperar el registro.
                    <br><br>
                    <div class="form-group">
                    <div class="form-group">
                    <label for="id_medico">ID_MEDICO:</label>
                    <input type="text" name="id_medico" id="id_medico" class="form-control" value="<?php echo $dato['id_medico'];?>" >
</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>