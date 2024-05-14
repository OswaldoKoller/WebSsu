<?php
require_once("../CapaDato/citaMedicaDAO.php");

class cita_medicas
{
    private $id_ficha;
    private $diagnostico;
    private $motivo;
    private $tratamiento;
    private $indicaciones;
    private $database;
    private $citaDAO;

    public function __construct()
    {
        $this->database = new Database();
        $this->citaDAO = new CitaMedicaDAO($this->database);
    }

    public function insertarCitaMedica()
    {
        return $this->citaDAO->insertarCitaMedica($this->id_ficha, $this->diagnostico, $this->motivo, $this->tratamiento, $this->indicaciones);
    }
}
?>
