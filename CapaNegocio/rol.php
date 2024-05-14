<?php
require_once "../CapaDato/rolDAO.php";
require_once "../CapaDato/conexion.php";
require_once "usuario.php";

class rol{
    private $database;
    private $usuario ;
    private $rolDAO;
    private $id_rol;
    private $nombre_rol;
    private $descripcion_rol;
    private $estado_rol;


    public function __construct(){
        $this->database = new Database();
        $this -> rolDAO = new rolDAO($this->database);
        $this-> usuarios = new usuario($this->database);
    }
    public function allrol() {
         return $this->rolDAO->obtenerRol(); 
        }
    public function insertRol($nombre_rol, $descripcion_rol,$estado_rol){
     
        $this->nombre_rol =$nombre_rol;
        $this->descripcion_rol =$descripcion_rol;
        $this->estado_rol =$estado_rol;

        return $this -> rolDAO->insert($nombre_rol, $descripcion_rol,$estado_rol);

    }
    public function update_rol($nombre_rol,$descripcion_rol,$id_rol){
        $this->id_rol=$id_rol;
        $this->nombre_rol=$nombre_rol;
        $this->descripcion_rol=$descripcion_rol;	
        return $this->rolDAO->update($nombre_rol,$descripcion_rol,$id_rol );

    }
    public function buscarxnombre($nombre_rol){
        $this ->nombre_rol = $nombre_rol;
        return $this-> rolDAO->obtenerDatosRol($this->nombre_rol);
    }
    public function eliminar($id_rol){
        $this->id_rol = $id_rol;
        return $this->rolDAO->delete($id_rol);
    }
    public function asignacion(){
        return $this->rolDAO->tasignacion();
    }
    public function insertAsignacion($id_usuario,$id_rol){
        return $this->rolDAO->insertAsignacion($id_usuario,$id_rol);
    }
}













?>