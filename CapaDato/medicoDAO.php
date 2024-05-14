<?php

require_once('conexion.php');


class medicoDAO {
    private $database;
    private $conn;
    private $table = 'tmedico';

    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }

    // Traer toda la información de la tabla persona
    public function obtenerTodasLasMedicos() {
        $query = "SELECT m.id_medico, p.nombre, p.apellido, m.estado
        FROM tmedico m
        JOIN tpersona p ON m.id_persona = p.id_persona
        WHERE M.estado= 1;";
        $result = $this->conn->query($query);
    
        if ($result !== false) {
            $medicos = $result->fetch_all(MYSQLI_ASSOC);
            return $medicos;
        } else {
            return false;
        }
    }

    public function obtenerMedicosPorEspecialidad($id_especialidad) {
        $query = "SELECT m.id_medico, p.nombre, p.apellido, m.estado, e.nombre_especialidad
                  FROM tmedico m
                  JOIN tpersona p ON m.id_persona = p.id_persona
                  JOIN tespecialidad e ON m.id_especialidad = e.id_especialidad
                  WHERE e.id_especialidad = ? AND m.estado = 1;";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id_especialidad);

        if ($stmt->execute()) {
            $result = array();
            $stmt->bind_result($id_medico, $nombre, $apellido, $estado, $nombre_especialidad);

            while ($stmt->fetch()) {
                $row = array(
                    'id_medico' => $id_medico,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'estado' => $estado,
                    'nombre_especialidad' => $nombre_especialidad
                );
                $result[] = $row;
            }

            $stmt->close();

            return $result;
        } else {
            return false;
        }
    }
    public function buscarMedicos(){
        $query = "SELECT m.id_medico, p.nombre, p.apellido, m.estado
            FROM tmedico m
            JOIN tpersona p ON m.id_persona = p.id_persona
            WHERE m.estado = 1;";
            
        $stmt = $this->conn->prepare($query);
        
        if ($stmt->execute()) {
            $result = array();
            $stmt->bind_result($id_medico, $nombre, $apellido, $estado);
            
            while ($stmt->fetch()) {
                $row = array(
                    'id_medico' => $id_medico,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'estado' => $estado
                );
                $result[] = $row;
            }
            
            $stmt->close();
            
            return $result;
        } else {
            return false;
        }
    }
    public function delete($id_medico) {
        $sql = "UPDATE $this->table SET estado = 0 WHERE id_medico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_medico);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }
    public function obtenerPacientesPorMedico($idMedico) {
        try {
            // Aquí asumo que existe una relación entre tficha e historia_clinica a través de id_historia
            $query = "SELECT f.id_ficha, f.fecha_atencion, p.*, pe.nombre as nombre_paciente, pe.apellido as apellido_paciente FROM tficha f 
            JOIN tpaciente p ON f.id_paciente = p.id_paciente 
            JOIN tpersona pe ON p.id_persona = pe.id_persona 
            WHERE f.id_medico = ?";
    
            $stmt = $this->conn->prepare($query);
    
            if (!$stmt) {
                // Muestra información sobre el error de preparación
                echo 'Error de preparación: ' . mysqli_error($this->conn);
                // O lanza una excepción personalizada, según tus necesidades
                throw new Exception("Error de preparación de consulta SQL");
            }
    
            $stmt->bind_param('i', $idMedico);
            $stmt->execute();
    
            // Obtén los resultados como un array asociativo
            $resultados = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
            return $resultados;
        } catch (Exception $e) {
            // Maneja cualquier otra excepción aquí
            return false;
        }
    }
    
    
}
