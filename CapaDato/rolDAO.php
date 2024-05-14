<?php

require_once('conexion.php');

class RolDAO {
    private $database;
    private $conn;
    private $table = 'trol';

    public function __construct($database){
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }

    public function obtenerRol(){
        $query = "SELECT * FROM $this->table WHERE estado_rol = 1";
        $result = $this->conn->query($query);
        $rol = $result->fetch_all(MYSQLI_ASSOC);
        return $rol;
    }
    public function buscarrol($nombre_rol){
        $query="SELECT * FROM $this->table WHERE nombre_rol = ? AND estado_rol = 1";
        $result =$this->conn->query($query);

    }

    public function insert($nombre_rol, $descripcion_rol, $estado_rol) {
        $sql = "INSERT INTO $this->table (nombre_rol, descripcion_rol, estado_rol) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $nombre_rol, $descripcion_rol, $estado_rol);
        
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function update( $nombre_rol, $descripcion_rol,$id_rol,) {
        $sql = "UPDATE $this->table SET nombre_rol = ?, descripcion_rol = ? WHERE id_rol = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $nombre_rol, $descripcion_rol, $id_rol);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($id_rol) {
        $sql = "UPDATE $this->table SET estado_rol = 0 WHERE id_rol = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_rol);
    
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
   

    public function obtenerDatosRol($nombre_rol){
        $query = "SELECT * FROM $this->table WHERE nombre_rol = ? AND estado_rol = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $nombre_rol);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function obtenertodoslosrol(){
        
        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);
        $rol = $result->fetch_all(MYSQLI_ASSOC);
        return $rol;
    }

    public function asignar($id_rol,$id_usuario){
        $query="INSERT INTO tasignacion (id_usuario, id_rol) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $id_usuario,$id_rol);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function insertAsignacion($id_usuario, $id_rol) {
        $sql = "INSERT INTO `tasignacion`(`id_asignacion`, `id_usuario`, `id_rol`, `fecha_asignacion`) VALUES (NULL,?,?,now())";
        $stmt = $this->conn->prepare($sql);
    
        // Vincular los parámetros
        $stmt->bind_param("ii", $id_usuario, $id_rol);
    
        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true; // Éxito al insertar
        } else {
            return false; // Error al insertar
        }
    }
    
    
    
    //FUNCIONES Y PROCEDIMIENTOS PARA ASIGNAR
    public function tasignacion() {
        $sql = "SELECT 
        a.id_asignacion,
        u.id_usuario,
        u.nombre_usuario,
        r.id_rol,
        r.nombre_rol
    FROM
        tasignacion a
    INNER JOIN
        tusuario u ON a.id_usuario = u.id_usuario
    INNER JOIN
        trol r ON a.id_rol = r.id_rol;";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $asignaciones = $result->fetch_all(MYSQLI_ASSOC);
            return $asignaciones;
        } else {
            return false;
        }
    }
    

}

?>
