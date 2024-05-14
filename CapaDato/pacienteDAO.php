<?php

require_once('conexion.php');
require_once('../CapaNegocio/persona.php');

class pacienteDAO {
    private $database;
    private $conn;
    private $id_persona;
    private $nombre;
    private $persona;
    private $table = 'tpaciente';

    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
        $this->persona = new persona(); // Inicializar la propiedad $persona en el constructor
    }

    public function mostrar() {
        $sql = "SELECT
            tp.id_paciente,
            tp.id_persona,
            tpn.nombre,
            tpn.apellido,
            tp.fecha_creacion
        FROM
            tpaciente AS tp
        JOIN
            tpersona AS tpn ON tp.id_persona = tpn.id_persona;";
        $result = $this->conn->query($sql);

        if ($result !== false) {
            $pacientes = $result->fetch_all(MYSQLI_ASSOC);
            return $pacientes;
        } else {
            return false;
        }
    }

    public function buscarPersona($nombre) {
        return $this->persona->buscarxnombre($nombre); // Corregir la llamada a la función
    }

    public function insert($id_persona, $fecha_creacion) {
        // La sentencia SQL con placeholders (?, ?)
        $sql = "INSERT INTO `tpaciente` (`id_paciente`, `id_persona`, `fecha_creacion`) VALUES (NULL, ?, ?)";

        // Preparar la sentencia SQL
        $stmt = $this->conn->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular los valores a los placeholders y especificar el tipo de dato para cada uno
            $stmt->bind_param("is", $id_persona, $fecha_creacion);

            // Ejecutar la sentencia preparada
            if ($stmt->execute()) {
                return true; // La inserción fue exitosa
            } else {
                return false; // Error en la ejecución de la sentencia preparada
            }

            // Cerrar la sentencia preparada
            $stmt->close();
        } else {
            return false; // Error en la preparación de la sentencia SQL
        }
    }
}
?>
