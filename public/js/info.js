document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formActualizarUsuario').addEventListener('submit', function(e) {
        e.preventDefault(); // Evitar el envío del formulario por defecto

        const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario
        formData.append('metodo', 'actualizarDatos'); // Agregar el método para identificar la acción

        fetch('./app/controller/datos.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(result => {
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualización Exitosa!',
                    text: result.message,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#1565c0'
                });

                // Actualiza el campo de usuario con el nuevo valor
                document.getElementById('usuario').value = result.nuevoUsuario;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: result.message,
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#d32f2f'
                });
            }
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo procesar la solicitud.',
                confirmButtonText: 'Aceptar',
                confirmButtonColor: '#d32f2f'
            });
        });
    });
});
