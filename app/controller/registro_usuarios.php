<?php



require_once '../config/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    
    $checkQuery = "SELECT * FROM t_usuario WHERE usuario = :usuario";
    $stmt = $conexion->prepare($checkQuery);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        
        echo json_encode(['success' => false, 'message' => 'El usuario ya existe.']);
    } else {
        
        $insertQuery = "INSERT INTO t_usuario (usuario, password) VALUES (:usuario, :password)";
        $stmt = $conexion->prepare($insertQuery);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password); // Almacena la contraseña como un entero

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Registrado correctamente.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al registrar.']);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
