<?php
require_once( "../CapaDato/pacienteDAO.php" );


class paciente
{
   private $id_paciente;
   private $id_persona;
   private $nombre;
   private $apellido;
   private $fecha_creacion;
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->paciente = new pacienteDAO($this->database);
    }
    public function tpacientes(){
        return $this->paciente->mostrar();
    }
    public function insert($id_persona,$fecha_creacion){
        return $this->paciente->insert($id_persona,$fecha_creacion);
    }
    
 }
    

?>