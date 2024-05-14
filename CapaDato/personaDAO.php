<?php

require_once('conexion.php');


class PersonaDAO {
    private $database;
    private $conn;
    private $table = 'tpersona';

    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }

    // Traer toda la información de la tabla persona
    public function obtenerTodasLasPersonas() {
        $query = "SELECT * FROM $this->table WHERE estado = 1";
        $result = $this->conn->query($query);
        $personas = $result->fetch_all(MYSQLI_ASSOC);
        return $personas;
    }

    // Insertar registros en la base de datos persona
    public function insert($id_persona, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $direccion, $estado) {
        $sql = "INSERT INTO $this->table (id_persona, nombre, apellido, fecha_nacimiento, telefono, correo, direccion, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $id_persona, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $direccion, $estado);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }
    public function update($nombre, $apellido, $telefono, $id_persona) {
        $sql = "UPDATE $this->table SET nombre = ?, apellido = ?, telefono = ? WHERE id_persona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $apellido, $telefono, $id_persona);
        
        if ($stmt->execute()) {
            echo "actualizado correctamente";
            return true;
        } else {
            echo "Error al actulizar: " . $stmt->error;
            return false;
        }
    
        $stmt->close();
    }
    // Obtener los datos de una persona por su ID
    public function obtenerDatosPersona($personaId) {
        $query = "SELECT * FROM $this->table WHERE id_persona = $personaId";
        $result = $this->conn->query($query);

        return $result->fetch_assoc();
    }
    public function delete($id_persona) {
        $sql = "DELETE FROM $this->table WHERE id_persona = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_persona);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    
        $stmt->close();
    }
    public function buscarxnombre($nombre){
        $sql = "SELECT `id_persona`, `nombre`, `apellido`, `fecha_nacimiento`, `telefono`, `correo`, `direccion`, `fecha_creacion`, `estado`
                FROM `tpersona` WHERE nombre = ?";
    
        $stmt = $this->conn->prepare($sql);
    
        // Verificar si la preparación fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $nombre);
    
            if ($stmt->execute()) {
                // Aquí puedes obtener los resultados de la consulta
                $result = $stmt->get_result();
                $datosPersona = $result->fetch_all(MYSQLI_ASSOC);
                return $datosPersona;
            } else {
                return false; // Error en la ejecución de la consulta
            }
    
            $stmt->close();
        } else {
            return false; // Error en la preparación de la consulta
        }
    }
    
}

?>