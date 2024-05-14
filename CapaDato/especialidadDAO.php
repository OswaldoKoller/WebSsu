<?php 
require_once('../CapaDato/conexion.php');
class especialidadDAO {
    private $database;
    private $conn;
    private $table = 'tespecialidad';
    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }
    public function tespecialidad(){
        $sql = "SELECT * FROM tespecialidad";
        $result = $this->conn->query($sql);
        if ($result !== false) {
            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                $especialidades = array();
                while ($row = $result->fetch_assoc()) {
                    $especialidades[] = $row;
                }
                return $especialidades;
            } else {
                return array();
            }
        } else {
            return false;
        }
    }
    public function busca_especialidad($nombre_especialidad) {
        $sql = "SELECT * FROM tespecialidad WHERE nombre_especialidad = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $nombre_especialidad);
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $especialidad = $result->fetch_assoc();
                    return $especialidad;
                } else {
                    return null;
                }
            } else {
                return false;
            }
            $stmt->close();
        } else {
            return false;
        }
    }
    public function insert($nombre, $estado) {
        // Sentencia SQL con placeholders (?, ?)
        $sql = "INSERT INTO `tespecialidad`( `nombre_especialidad`, `estado`) VALUES ( ?, ?)";
    
        // Preparar la sentencia SQL
        $stmt = $this->conn->prepare($sql);
    
        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular los valores a los placeholders y especificar el tipo de dato para cada uno
            $stmt->bind_param("si", $nombre, $estado);
    
            // Ejecutar la sentencia preparada
            if ($stmt->execute()) {
                // Cerrar la sentencia preparada
                $stmt->close();
                return true; // La inserción fue exitosa
            } else {
                // Error en la ejecución de la sentencia preparada
                $stmt->close();
                return false;
            }
        } else {
            // Error en la preparación de la sentencia SQL
            return false;
        }
    }
    public function update($idEspecialidad, $nombre, $estado) {
        // Sentencia SQL con placeholders (?, ?, ?)
        $sql = "UPDATE `tespecialidad` SET `nombre_especialidad` = ?, `estado` = ? WHERE `id_especialidad` = ?";
        
        // Preparar la sentencia SQL
        $stmt = $this->conn->prepare($sql);
        
        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular los valores a los placeholders y especificar el tipo de dato para cada uno
            $stmt->bind_param("sii", $nombre, $estado, $idEspecialidad);
        
            // Ejecutar la sentencia preparada
            if ($stmt->execute()) {
                // Cerrar la sentencia preparada
                $stmt->close();
                return true; // La actualización fue exitosa
            } else {
                // Error en la ejecución de la sentencia preparada
                $stmt->close();
                return false;
            }
        } else {
            // Error en la preparación de la sentencia SQL
            return false;
        }
    }
        public function softDelete($idEspecialidad) {
            // Sentencia SQL con placeholders (?)
            $sql = "UPDATE `tespecialidad` SET `estado` = 0 WHERE `id_especialidad` = ?";
            
            // Preparar la sentencia SQL
            $stmt = $this->conn->prepare($sql);
            
            // Verificar si la preparación fue exitosa
            if ($stmt) {
                // Vincular el valor al placeholder y especificar el tipo de dato
                $stmt->bind_param("i", $idEspecialidad);
            
                // Ejecutar la sentencia preparada
                if ($stmt->execute()) {
                    // Cerrar la sentencia preparada
                    $stmt->close();
                    return true; // La eliminación lógica fue exitosa
                } else {
                    // Error en la ejecución de la sentencia preparada
                    $stmt->close();
                    return false;
                }
            } else {
                // Error en la preparación de la sentencia SQL
                return false;
            }
        }
    }
    
?>
