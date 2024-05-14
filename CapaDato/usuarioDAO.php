<?php
require_once('conexion.php');
class UsuarioDAO {
    private $database;
    private $conn;
    private $table = 'tusuario';
    public function __construct($database) {
        $this->database = $database;
        $this->conn = $this->database->getConn();
    }
    public function obtenerTodosLosUsuarios() {
        $query = "SELECT * FROM $this->table";
        $result = $this->conn->query($query);
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        return $usuarios;
    }
    // Insertar en la tabla usuario
    public function insert($id_persona,$username, $password, $estado) {
        $sql = "INSERT INTO $this->table (id_persona,nombre_usuario, pass_usuario, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isss",$id_persona, $username, $password, $estado);
        return $stmt->execute();
    }
    // Obtener los datos de un usuario por su nombre de usuario
    public function obtenerDatosUsuario($username) {
        $query = "SELECT * FROM $this->table WHERE nombre_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function obtenerDatosPersonaUsuario() {
        $query = "SELECT p.id_persona, p.nombre, p.apellido,p.telefono, p.direccion, u.id_usuario,u.nombre_usuario
        FROM tpersona AS p
        INNER JOIN tusuario AS u ON p.id_persona = u.id_persona
        WHERE p.estado =1 AND u.estado =1";
        $result = $this->conn->query($query);
        $datos = $result->fetch_all(MYSQLI_ASSOC);
        return $datos;
    }
    public function buscarUsuario($username) {
        // Preparar la consulta SQL
        $query = "SELECT id_usuario, id_persona,nombre_usuario, pass_usuario FROM tusuario WHERE nombre_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        // Retornar los datos del usuario si se encontró, o null si no se encontró
        return $result->fetch_assoc();
    }
    public function update($username, $password, $usuarioId) {
        // Preparar la consulta SQL para actualizar los datos del usuario
        $sql = "UPDATE tusuario SET nombre_usuario='$username', pass_usuario='$password' WHERE id_usuario=$usuarioId";
        //$sql="UPDATE $this->$table SET `nombre_usuario`='$username',`pass_usuario`='$password',`estado`='$estado' WHERE id_usuario=$usuarioId";
        if ($this->conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            return true;
        } else {
            echo "Error updating record: " . $this->conn->error;
            return false;
        }
        $this->conn->close();
    }
    // Eliminar un usuario por su ID
    public function eliminar($usuarioId) {
       // $query = "DELETE FROM $this->table WHERE id = ?";
       $query = "UPDATE $this->table SET estado = '0' WHERE id_usuario = ?";
       $stmt = $this->conn->prepare($query);
       $stmt->bind_param("i", $usuarioId); // Debes pasar una variable aquí
       $stmt->execute();
        // Retornar true si la eliminación fue exitosa, o false en caso contrario
        return $stmt->affected_rows > 0;
    }
}
?>   