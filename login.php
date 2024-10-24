<?php
require_once './app/config/conexion.php'; 
$query = "SELECT * FROM t_producto";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- FontAwesome -->
    <style>
        body {
            background: linear-gradient(to right, #3a7bd5, #3a6073);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 400px; 
            width: 100%;
        }
        .login-btn {
            background-color: #2196F3; 
            color: white;
        }
        .icon-container {
            position: relative;
        }
        .icon-container input {
            padding-left: 40px; 
        }
        .icon-container i {
            position: absolute;
            left: 10px;
            top: 50%; 
            transform: translateY(-50%); 
            color: #2196F3; 
        }
        h3 {
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center"><i class="fas fa-user-lock"></i> Iniciar Sesión</h3>
        <form id="loginForm" action="#" method="POST">
            <div class="mb-3 icon-container">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="mb-3 icon-container">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class="d-grid">
                <button type="submit" id="btn_iniciar" class="btn login-btn"><i class="fas fa-sign-in-alt"></i> Login</button>
                <br>
                <button type="button" class="btn btn-warning w-100" onclick="window.location.href='registro.php';">
    <i class="fas fa-user-plus"></i> Registrar
</button>

</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- SweetAlert -->
    <script src="./public/js/login.js"></script>
</body>
</html>
