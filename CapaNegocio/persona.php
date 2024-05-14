<?php
require_once "../CapaDato/personaDAO.php";
require_once "../CapaDato/conexion.php";

class Persona {
    private $personaDAO;
    private $id_persona;
    private $nombre;
    private $apellido;
    private $fecha_nacimiento;
    private $telefono;
    private $correo;
    private $direccion;
    private $estado;
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->personaDAO = new PersonaDAO($this->database);
    }

    // Obtener todas las personas
    public function obtenerTodasLasPersonas() {
        return $this->personaDAO->obtenerTodasLasPersonas();
    }

    // Insertar una persona
       public function insert($id_persona, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $direccion, $estado) {
        $this->id_persona = $id_persona;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->direccion = $direccion;
        $this->estado = $estado; 
        
        return $this->personaDAO->insert($id_persona, $nombre, $apellido, $fecha_nacimiento, $telefono, $correo, $direccion, $estado);
    }
    public function update($nombre,$apellido,$telefono,$id_persona){
        return $this->personaDAO->update($nombre,$apellido,$telefono,$id_persona);
    }
    public function eliminar($id_persona){
        return $this->personaDAO->delete($id_persona);
    }
    // Obtener los datos de una persona por su ID
    public function obtenerDatosPersona($personaId) {
        return $this->personaDAO->obtenerDatosPersona($personaId);
    }
    public function buscarxnombre($nombre){
        return $this->personaDAO->buscarxnombre($nombre);
    }

    //obtener carnet
    public function getci(){
        return $this->ci_persona;
    }
    //devolver ci
    public function setci($ci_perso){
        $this->ci_persona=$ci_perso;
    }
    // Obtener el nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Establecer el nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Obtener el apellido
    public function getApellido() {
        return $this->apellido;
    }

    // Establecer el apellido
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // Obtener la dirección
    public function getDireccion() {
        return $this->direccion;
    }

    // Establecer la dirección
    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }
}

// Crear una instancia de la clase Persona
$persona = new Persona();

// Luego puedes llamar a los métodos de la clase Persona
$personas = $persona->obtenerTodasLasPersonas();
// Resto del código

?>