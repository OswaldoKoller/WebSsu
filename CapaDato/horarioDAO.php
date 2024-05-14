<?php
require_once "conexion.php";


class horarioDAO {
    private $database;
    private $conn;
    private $table = 'horarios';

    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }
    public function getHorario(){
        $query=""
    }
}