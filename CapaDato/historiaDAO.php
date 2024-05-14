<?php 
require_once('../CapaDato/conexion.php');
class historiaCLinicaDAO {
    private $database;
    private $conn;
    private $table = 'cita_medica';
    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
  
    }
}
?>