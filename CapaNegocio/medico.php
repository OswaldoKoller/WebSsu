<?php
require_once( "../CapaDato/medicoDAO.php" );


class medico 
{
    private $id_medico;
    private $medicoDAO;
    private $id_persona;
    private $nombre;
    private $apellido;
    private $id_usuario;
    private $nombre_usuario;
    private $estado;
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->medicoDAO = new medicoDAO($this->database);
    }
    public function mostrartodos(){
        return $this->medicoDAO->obtenerTodasLasMedicos();
    }
    public function busqueda($id_medico){
        return $this->medicoDAO->buscarMedico($id_medico);
    }
    public function delete($id_medico){
        return $this->medicoDAO->delete($id_medico);
    }
    public function medicoxespe($id_especialidad){
        return $this->medicoDAO->medicoxespecialidad($id_especialidad);
    }
 }
    

?>