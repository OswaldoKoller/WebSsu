<?php
require_once('../CapaDato/conexion.php');

class CitaMedicaDAO
{
    private $conn;

    public function __construct($database)
    {
        $this->conn = $database->getConn();
    }

    public function insertarCitaMedica($datosCitaMedica)
    {
        try {
            $query = "INSERT INTO cita_medica (id_ficha, diagnostico, motivo, tratamiento, indicacion, fecha_emision) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);

            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
            }

            $stmt->bind_param(
                'ississ',
                $datosCitaMedica['id_ficha'],
                $datosCitaMedica['diagnostico'],
                $datosCitaMedica['motivo'],
                $datosCitaMedica['tratamiento'],
                $datosCitaMedica['indicacion'],
                $datosCitaMedica['fecha_emision']
            );

            $result = $stmt->execute();

            if ($result) {
                return true;
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        } finally {
            if ($stmt) {
                $stmt->close();
            }
        }
    }
    public function obtenerCitasMedicasPorPaciente($id_paciente)
{
    try {
        $query = "SELECT CM.id_cita, CM.id_ficha, CM.motivo, CM.diagnostico, CM.tratamiento, CM.indicacion, CM.fecha_emision, CONCAT(P.nombre, ' ', P.apellido) AS nombre_paciente 
                  FROM cita_medica CM 
                  JOIN tficha TF ON CM.id_ficha = TF.id_ficha 
                  JOIN tpaciente TP ON TF.id_paciente = TP.id_paciente 
                  JOIN tpersona P ON TP.id_persona = P.id_persona 
                  WHERE TP.id_paciente = ?";

        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta: " . $this->conn->error);
        }

        $stmt->bind_param('i', $id_paciente);

        $result = $stmt->execute();

        if ($result) {
            $result_set = $stmt->get_result();
            $citas_medicas = $result_set->fetch_all(MYSQLI_ASSOC);
            return $citas_medicas;
        } else {
            throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    } finally {
        if ($stmt) {
            $stmt->close();
        }
    }
}

}
?>
