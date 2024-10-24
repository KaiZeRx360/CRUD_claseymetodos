<?php
session_start();

require_once './app/config/conexion.php'; 

// Ejecutar la consulta para obtener los productos
$query = "SELECT * FROM t_producto";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suits - Gestión de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./public/css/main.css">
    <link rel="stylesheet" href="./public/css/dt.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
        <a href="./info.php" class="btn btn-info">Informacion</a>
        <a class="btn btn-secondary" href="login.php"><i class="fas fa-sign-in-alt"></i> Cerrar Sesión</a>
        <br>
        <h2>Agregar productos</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-body bg-dark text-light">
                        <form id="formAgregarProducto">
                            <div class="form-group">
                                <label for="nombre_producto">Nombre del Producto:</label>
                                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
                            </div>
                            <div class="form-group">
                                <label for="precio_producto">Precio:</label>
                                <input type="number" class="form-control" id="precio_producto" name="precio_producto" required step="0.01">
                            </div>
                            <div class="form-group">
                                <label for="cantidad_producto">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" required>
                            </div>
                            <button type="submit" class="btn btn-success">Agregar <i class="fas fa-plus"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <h3 class="mt-8">Lista de Productos</h3>
                <table class="table table-dark table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- El contenido de la tabla será cargado dinámicamente por JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalActualizar" tabindex="-1" aria-labelledby="modalActualizarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalActualizarLabel">Actualizar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formActualizarProducto">
                        <input type="hidden" id="id_producto" name="id_producto">
                        <div class="form-group">
                            <label for="nombre_producto_modal">Nombre del Producto:</label>
                            <input type="text" class="form-control" id="nombre_producto_modal" name="nombre_producto_modal" required>
                        </div>
                        <div class="form-group">
                            <label for="precio_producto_modal">Precio:</label>
                            <input type="number" class="form-control" id="precio_producto_modal" name="precio_producto_modal" required step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="cantidad_producto_modal">Cantidad:</label>
                            <input type="number" class="form-control" id="cantidad_producto_modal" name="cantidad_producto_modal" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Producto <i class="fas fa-save"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="./public/js/main.js"></script>
    <script src="./public/js/dt.js"></script>
</body>
</html>