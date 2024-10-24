<?php
require_once '../config/conexion.php';

class Productos extends Conexion {

    public function obtener_datos() {
        $consulta = $this->obtener_conexion()->prepare("SELECT * FROM t_producto");
        $consulta->execute();
        $datos = $consulta->fetchAll(PDO::FETCH_ASSOC);
        $this->cerrar_conexion();
        echo json_encode($datos);
    }

    public function insertar_datos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre_producto = $_POST['nombre_producto'];
            $precio_producto = $_POST['precio_producto'];
            $cantidad_producto = $_POST['cantidad_producto'];

            $insercion = $this->obtener_conexion()->prepare("INSERT INTO t_producto (producto, precio, cantidad) VALUES (:producto, :precio, :cantidad)");
            $insercion->bindParam(':producto', $nombre_producto);
            $insercion->bindParam(':precio', $precio_producto);
            $insercion->bindParam(':cantidad', $cantidad_producto);

            if ($insercion->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto agregado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al agregar el producto.']);
            }
            $this->cerrar_conexion();
        }
    }

    public function actualizar_datos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $nombre_producto = $_POST['nombre_producto_modal'];
            $precio_producto = $_POST['precio_producto_modal'];
            $cantidad_producto = $_POST['cantidad_producto_modal'];

            $actualizacion = $this->obtener_conexion()->prepare("UPDATE t_producto SET producto = :producto, precio = :precio, cantidad = :cantidad WHERE id_producto = :id");
            $actualizacion->bindParam(':producto', $nombre_producto);
            $actualizacion->bindParam(':precio', $precio_producto);
            $actualizacion->bindParam(':cantidad', $cantidad_producto);
            $actualizacion->bindParam(':id', $id_producto);

            if ($actualizacion->execute()) {
                echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto.']);
            }
            $this->cerrar_conexion();
        }
    }

    public function eliminar_datos() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asegúrate de que estás obteniendo el ID del producto de la forma correcta
            if (isset($_POST['id_producto'])) { // Usamos $_POST aquí, ya que estamos usando FormData
                $id_producto = $_POST['id_producto']; // Obtener el ID del producto de la solicitud
    
                $eliminacion = $this->obtener_conexion()->prepare("DELETE FROM t_producto WHERE id_producto = :id_producto");
                $eliminacion->bindParam(':id_producto', $id_producto, PDO::PARAM_INT); // Especificar el tipo de dato
    
                if ($eliminacion->execute()) {
                    echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto.']);
                }
                $this->cerrar_conexion();
            } else {
                echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado.']);
            }
        }
    }
}
    

$consulta = new Productos();
$metodo=$_POST ['metodo'];
$consulta->$metodo();
?>