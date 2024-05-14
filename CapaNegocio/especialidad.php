<?php
require_once( "../CapaDato/especialidadDAO.php" );


class especialidad 
{
    private $id_especialidad;
    private $especialidadDAO;
    private $nombre_especialidad;
    private $estado;
    private $id_horario;
    private $database;


    public function __construct() {
        $this->database = new Database();
        $this->especialidad = new especialidadDAO($this->database);
    }
    public function tespecialidad(){
        return $this->especialidad->tespecialidad();
    }
    public function insert($nombre,$estado){
        return $this->especialidad->insert($nombre,$estado);
    }
    public function update($nombre,$estado,$id_especialidad){
        return $this->especialidad->update($nombre,$estado,$id_especialidad);
    }
    public function buscarEspecialidad($nombre_especialidad){
        return $this->especialidad->busca_especialidad($nombre_especialidad);
    }
}

?>