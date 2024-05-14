<?php
require_once('../CapaDato/fichaDAO.php');

class ficha 
{
    private $id_ficha;
    private $id_paciente;
    private $id_medico;
    private $fecha_atencion;
    private $estado;
    private $database;
   
    private $fichaDAO;

    public function __construct() {
        $this->database = new Database();
        $this->fichaDAO = new fichaDAO($this->database);
    }

    public function agregarFicha($id_paciente, $id_especialidad, $id_medico, $fecha_atencion,$estado) {
        // Puedes ajustar los parámetros según tu necesidad
        return $this->fichaDAO->insertarFicha($id_paciente, $id_especialidad, $id_medico, $fecha_atencion,$estado);
    }

    public function mostrarFichasPorFecha($fecha_inicio, $fecha_fin) {
        return $this->fichaDAO->mostrarFichasPorFecha($fecha_inicio, $fecha_fin);
    }

    public function mostrarFichasPorMedico($id_medico) {
        return $this->fichaDAO->mostrarFichasPorMedico($id_medico);
    }

    public function contarFichasAtendidasPorMedico($id_medico) {
        return $this->fichaDAO->contarFichasAtendidasPorMedico($id_medico);
    }
}
?>
