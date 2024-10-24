// Función para cargar productos desde el servidor
const cargarProductos = () => {
    fetch("app/controller/Productos.php", {
        method: 'POST',
        body: new URLSearchParams({ metodo: 'obtener_datos' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.length) { // Verifica que haya datos en la respuesta
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = ''; // Limpiar el tbody
            data.forEach(producto => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${producto.id_producto}</td>
                    <td>${producto.producto}</td>
                    <td>${producto.precio}</td>
                    <td>${producto.cantidad}</td>
                    <td>
                        <button class="btn btn-warning" onclick="abrirModalActualizar(${producto.id_producto}, '${producto.producto}', ${producto.precio}, ${producto.cantidad})">Actualizar</button>
                        <button class="btn btn-danger" onclick="eliminarProducto(${producto.id_producto})">Eliminar</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            $('#myTable').DataTable(); // Inicializar DataTable
        } else {
            swal("Error", "No se encontraron productos.", "error");
        }
    })
    .catch(error => {
        swal("Error", "No se pudo cargar los productos.", "error");
    });
};

// Función para agregar un producto
document.getElementById('formAgregarProducto').addEventListener('submit', (event) => {
    event.preventDefault(); 
    const formData = new FormData(event.target);
    formData.append('metodo', 'insertar_datos');

    fetch("app/controller/Productos.php", {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            swal("Éxito", data.message, "success");
            cargarProductos(); 
            event.target.reset(); 
        } else {
            swal("Error", data.message, "error");
        }
    })
    .catch(error => {
        swal("Error", "No se pudo agregar el producto.", "error");
    });
});

// Función para abrir el modal de actualización de producto
const abrirModalActualizar = (id, nombre, precio, cantidad) => {
    document.getElementById('id_producto').value = id;
    document.getElementById('nombre_producto_modal').value = nombre;
    document.getElementById('precio_producto_modal').value = precio;
    document.getElementById('cantidad_producto_modal').value = cantidad;
    $('#modalActualizar').modal('show');
};

// Función para actualizar un producto
document.getElementById('formActualizarProducto').addEventListener('submit', (event) => {
    event.preventDefault(); 
    const formData = new FormData(event.target);
    formData.append('metodo', 'actualizar_datos');

    fetch("app/controller/Productos.php", {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            swal("Éxito", data.message, "success");
            cargarProductos(); 
            $('#modalActualizar').modal('hide'); 
        } else {
            swal("Error", data.message, "error");
        }
    })
    .catch(error => {
        swal("Error", "No se pudo actualizar el producto.", "error");
    });
});

// Función para eliminar un producto
// Función para eliminar un producto
const eliminarProducto = (id) => {
    swal({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, no podrás recuperar este producto.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            const formData = new FormData();
            formData.append('metodo', 'eliminar_datos'); // Asegúrate de que este método coincida con el que tienes en tu PHP
            formData.append('id_producto', id); // Aquí se añade el ID del producto a eliminar

            fetch("app/controller/Productos.php", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal("Éxito", data.message, "success");
                    cargarProductos(); 
                } else {
                    swal("Error", data.message, "error");
                }
            })
            .catch(error => {
                swal("Error", "No se pudo eliminar el producto.", "error");
            });
        }
    });
};




// Cargar los productos al iniciar
cargarProductos();

$(document).ready(function () {
    $('#myTable').DataTable({
        language: "./public/json/español.json"
    });
});
