<?php

require_once "../CapaDato/usuarioDAO.php";
require_once "../CapaDato/personaDAO.php";
require_once "../CapaDato/conexion.php";

class Usuario {
    private $usuarioDAO;
    private $id_persona;
    private $id_usuario;
    private $username;
    private $password;
    private $estado;
    public function __construct($database) {
        $this->database = new Database();
        $this->usuarioDAO = new UsuarioDAO($this->database);
    }

    // Insertar un nuevo usuario
    public function insert($id_persona,$username, $password, $estado) {
       
        $this->id_persona= $id_persona;
        $this->username = $username;
        $this->password = $password;
        $this ->estado = $estado;

        return $this->usuarioDAO->insert($id_persona,$username, $password, $estado);
    }


    // Obtener los datos de un usuario por su ID
    public function obtenerDatosUsuario($usuarioId) {
        return $this->usuarioDAO->obtenerDatosUsuario($usuarioId);
    }
    public function obtenerusuario(){
        return $this->usuarioDAO->obtenerTodosLosUsuarios();
    }
    
    public function buscarUsuario($username) {
        return $this->usuarioDAO->buscarUsuario($username);
    }

    public function update($username, $password, $usuarioId) {
        return $this->usuarioDAO->update( $username, $password,$usuarioId);
    }
    public function obtenerdatospersonausuarios(){
        return $this->usuarioDAO->obtenerDatosPersonaUsuario();
        }

    // Eliminar un usuario por su ID
    public function eliminar($usuarioId) {
        return $this->usuarioDAO->eliminar($usuarioId);
    }
    public function getid_persona(){
        return $this->id_persona;
    }
    public function setid_persona($id_persona) {
        $this->id_persona = $id_persona;
    }
    public function getid_username(){
        return $this->id_username;
    }
    public function setid_username($id_username) {
        $this->id_username = $id_username;
    }

    // Obtener el username
    public function getUsername() {
        return $this->username;
    }

    // Establecer el username
    public function setUsername($username) {
        $this->username = $username;
    }

    // Obtener la contraseña
    public function getPassword() {
        return $this->password;
    }

    // Establecer la contraseña
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getestado(){
        return $this->estado;
    }
    public function setestado($estado){
        $this->estado->$estado;
    }
    
}


?>