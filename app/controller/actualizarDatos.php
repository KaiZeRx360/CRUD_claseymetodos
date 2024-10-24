<?php

require_once '../config/conexion.php';

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recuperar el nombre de usuario actual desde la sesión
$usuarioActual = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nuevoUsuario = $_POST['usuario'];
    $password = $_POST['password'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE t_usuario SET usuario = :nuevo_usuario, password = :password WHERE usuario = :usuario_actual";
    $stmt = $conexion->prepare($query);
    $stmt->bindParam(':nuevo_usuario', $nuevoUsuario);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':usuario_actual', $usuarioActual);

    if ($stmt->execute()) {
        // Si la actualización es exitosa, actualizamos el nombre de usuario en la sesión
        $_SESSION['usuario'] = $nuevoUsuario;
        
        // Retornar el nuevo usuario en la respuesta
        echo json_encode([
            'status' => 'success',
            'message' => 'Datos actualizados correctamente',
            'nuevoUsuario' => $nuevoUsuario // Agregar el nuevo nombre de usuario
        ]);
    } else {
        $error = $stmt->errorInfo();
        echo json_encode([
            'status' => 'error',
            'message' => 'Hubo un error al actualizar los datos: ' . $error[2]
        ]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
