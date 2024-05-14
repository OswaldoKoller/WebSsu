<?php
require_once('../CapaDato/conexion.php');
class fichaDAO {
    private $database;
    private $conn;
    private $table = 'tficha';
     public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }
    function insertarFicha($idPaciente, $idEspecialidad, $idMedico, $fechaAtencion, $estado) {
        $sql = "INSERT INTO `tficha`(`id_paciente`, `id_especialidad`, `id_medico`, `fecha_atencion`, `estado`)
        VALUES (?, ?, ?, ?, ?)";
    
        // Preparar y ejecutar la declaración
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("iiiss", $idPaciente, $idEspecialidad, $idMedico, $fechaAtencion, $estado);
            $stmt->execute();
    
            // Verificar si la inserción fue exitosa
            if ($stmt->affected_rows > 0) {
                echo "Ficha insertada correctamente.";
            } else {
                echo "Error al insertar la ficha: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error en la preparación de la declaración: " . $this->conn->error;
        }
    }
  public function obtenerFichasPorCriterios($idEspecialidad, $fechaInicio) {
    $conn = $this->conn;
    $query = "SELECT tficha.*, tpersona_paciente.nombre AS nombre_paciente, tpersona_paciente.apellido
     AS apellido_paciente, tpersona_medico.nombre AS nombre_medico, tpersona_medico.apellido 
     AS apellido_medico, tespecialidad.nombre_especialidad 
     FROM tficha INNER JOIN tpaciente ON tficha.id_paciente = tpaciente.id_paciente 
     INNER JOIN tpersona AS tpersona_paciente ON tpaciente.id_persona = tpersona_paciente.id_persona 
     INNER JOIN tmedico ON tficha.id_medico = tmedico.id_medico 
     INNER JOIN tpersona AS tpersona_medico ON tmedico.id_persona = tpersona_medico.id_persona 
     INNER JOIN tespecialidad ON tficha.id_especialidad = tespecialidad.id_especialidad 
     WHERE tficha.id_especialidad = $idEspecialidad AND tficha.fecha_atencion >= $fechaInicio;";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conn->error;
        return [];
    }
    $result = $stmt->execute();
    if ($result === false) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
        return []; 
    }
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
public function cabecera($id_ficha){
    $conn = $this->conn;
    $query="SELECT tficha.*, tpersona_paciente.nombre AS nombre_paciente, tpersona_paciente.apellido AS
     apellido_paciente, tpersona_paciente.fecha_nacimiento, YEAR(CURRENT_DATE) - YEAR(tpersona_paciente.fecha_nacimiento) - (RIGHT(CURRENT_DATE, 5) < RIGHT(tpersona_paciente.fecha_nacimiento, 5)) 
     AS edad, tpersona_medico.nombre AS nombre_medico, tpersona_medico.apellido AS apellido_medico, tespecialidad.nombre_especialidad 
     FROM tficha 
    INNER JOIN tpaciente ON tficha.id_paciente = tpaciente.id_paciente 
    INNER JOIN tpersona AS tpersona_paciente ON tpaciente.id_persona = tpersona_paciente.id_persona 
    INNER JOIN tmedico ON tficha.id_medico = tmedico.id_medico 
    INNER JOIN tpersona AS tpersona_medico ON tmedico.id_persona = tpersona_medico.id_persona 
    INNER JOIN tespecialidad ON tficha.id_especialidad = tespecialidad.id_especialidad WHERE tficha.id_ficha =$id_ficha;";
     $stmt = $conn->prepare($query);

     // Verificar si la preparación fue exitosa
     if ($stmt === false) {
         echo "Error en la preparación de la consulta: " . $conn->error;
         return []; // O manejar el error de otra manera
     }
 
     // Ejecutar la consulta
     $result = $stmt->execute();
 
     // Verificar si la ejecución fue exitosa
     if ($result === false) {
         echo "Error al ejecutar la consulta: " . $stmt->error;
         return []; // O manejar el error de otra manera
     }
 
     // Obtener y devolver los resultados
     return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 }
    
}


?>
