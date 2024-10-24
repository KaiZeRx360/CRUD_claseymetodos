<?php

require_once '../config/conexion.php';

class UsuarioController extends Conexion {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'];
            $password = $_POST['password'];

            $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_usuario WHERE usuario = :usuario AND password = :password");
            $consulta->bindParam(':usuario', $usuario);
            $consulta->bindParam(':password', $password);

            $consulta->execute();

            // Verificar si se encontró un registro utilizando fetch
            if ($consulta->fetch(PDO::FETCH_ASSOC)) {
                $_SESSION['usuario'] = $usuario;
                echo json_encode(['success' => true, 'message' => 'Iniciaste sesión correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
            }

            $this->cerrar_conexion();
        } else {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
        }
    }
    }
    

    public function registrarUsuario() {
        $usuario = $_POST['usuario'];
        $password = $_POST['password']; // Usar la contraseña en texto plano
    
        $checkQuery = "SELECT * FROM t_usuario WHERE usuario = :usuario";
        $stmt = $this->obtener_conexion()->prepare($checkQuery);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => false, 'message' => 'El usuario ya existe.']);
        } else {
            $insertQuery = "INSERT INTO t_usuario (usuario, password) VALUES (:usuario, :password)";
            $stmt = $this->obtener_conexion()->prepare($insertQuery);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $password);
    
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Registrado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al registrar.']);
            }
        }
    }
    

    public function actualizarDatos() {
        if (!isset($_SESSION['usuario'])) {
            echo json_encode(['success' => false, 'message' => 'Acceso no autorizado.']);
            return;
        }
    
        $usuarioActual = $_SESSION['usuario'];
        $nuevoUsuario = $_POST['usuario'];
        $password = $_POST['password']; // Usar la contraseña en texto plano
    
        $query = "UPDATE t_usuario SET usuario = :nuevo_usuario, password = :password WHERE usuario = :usuario_actual";
        $stmt = $this->obtener_conexion()->prepare($query);
        $stmt->bindParam(':nuevo_usuario', $nuevoUsuario);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':usuario_actual', $usuarioActual);
    
        if ($stmt->execute()) {
            $_SESSION['usuario'] = $nuevoUsuario; // Actualizar el nombre de usuario en la sesión
            echo json_encode(['success' => true, 'message' => 'Datos actualizados correctamente', 'nuevoUsuario' => $nuevoUsuario]);
        } else {
            $error = $stmt->errorInfo();
            echo json_encode(['success' => false, 'message' => 'Hubo un error al actualizar los datos: ' . $error[2]]);
        }
    }
    
}

$consulta = new UsuarioController();
$metodo = $_POST['metodo'];
$consulta->$metodo();
?>
