<?php
session_start();
require_once './app/config/conexion.php';

// Verifica que el usuario esté autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recuperar el nombre de usuario actual desde la sesión
$usuarioActual = $_SESSION['usuario'];

// Obtener la contraseña actual desde la base de datos (si no la tienes en la sesión)
$query = "SELECT password FROM t_usuario WHERE usuario = :usuario_actual";
$stmt = $conexion->prepare($query);
$stmt->bindParam(':usuario_actual', $usuarioActual);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Si se encuentra el usuario
if ($result) {
    $passwordActual = $result['password']; // Obtenemos la contraseña actual
} else {
    $passwordActual = ''; // O algún valor por defecto
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="./public/css/info.css">
</head>
<body>
    <div class="card">
        <h2><i class="fas fa-user-edit"></i> Actualizar Usuario</h2>
        <!-- Formulario de actualización de usuario -->
        <form id="formActualizarUsuario">
            <div class="form-group">
                <label for="usuario">Nuevo Usuario:</label>
                <div class="input-group">
                    <i class="fas fa-user icon"></i>
                    <!-- Prellenamos el campo de usuario con el valor actual -->
                    <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo htmlspecialchars($usuarioActual); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <div class="input-group">
                    <i class="fas fa-lock icon"></i>
                    <!-- Prellenamos el campo de contraseña con el valor actual (aunque deberías cifrarla, por seguridad) -->
                    <input type="password" id="password" name="password" class="form-control" value="<?php echo htmlspecialchars($passwordActual); ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-custom mt-4"><i class="fas fa-sync-alt"></i> Actualizar Datos</button>
        </form>

        <div class="card-footer">
            <button class="btn btn-secondary mt-3" onclick="window.location.href='index.php'"><i class="fas fa-arrow-left"></i> Volver</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./public/js/main.js"></script>
</body>
</html>
