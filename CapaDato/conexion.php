<?php
class Database {
    private $host = 'localhost';
    private $username = 'admin';
    private $password = 'admssu00$$';
    private $database = 'test';

    // variable de conexion
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die('Error de conexión: ' . $this->conn->connect_error);
        }
    }

    /*PASO 1*/
    //Para recuperar la conexion de base de datos
    public function getConn() {
    return $this->conn;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM tusuario WHERE nombre_usuario = '$username' AND pass_usuario = md5('$password')";
        $result = $this->conn->query($query);

        return $result->num_rows > 0;
    }

    /*NUEVOS METODOS PARA MOSTRAR DATOS DE USUARIO*/
    public function obtenerDatosUsuario($username) {
        $query = "SELECT * FROM tusuario WHERE nombre_usuario = '$username'";
        $result = $this->conn->query($query);

        return $result->fetch_assoc();
    } 

    public function obtenerDatosPersona($personaId) {
        $query = "SELECT * FROM tpersona WHERE id_persona = $personaId";
        $result = $this->conn->query($query);

        return $result->fetch_assoc();
    }
    /*NUEVOS METODOS PARA MOSTRAR DATOS DE USUARIO*/
     public function getPersona() {
        return new Persona($this);
    }

    public function getUsuario() {
        return new Usuario($this);
    }

    public function obtenerDatosPersonaUsuario() {
    $query = "SELECT * FROM tpersona INNER JOIN tusuario ON tpersona.id_persona = tusuario.id_persona";
    $result = $this->conn->query($query);

    if ($result && $result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        die('Error en la consulta: ' . $this->conn->error);
    }
    }
}
?>