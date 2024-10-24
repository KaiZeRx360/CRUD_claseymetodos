document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        const usuario = document.getElementById('usuario').value;
        const password = document.getElementById('password').value;

        if (usuario && password) {
            const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario
            formData.append('metodo', 'login'); // Agregar el método para identificar la acción
    
            fetch('./app/controller/datos.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Parsear la respuesta JSON
            .then(resultado => {
                if (resultado.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: resultado.message, // Mensaje personalizado del servidor
                    }).then(() => {
                        window.location.href = 'index.php'; // Redirigir a la página de inicio
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: resultado.message, // Mensaje personalizado del servidor
                    });
                }
            })
            .catch(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en la conexión.',
                });
            });
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: 'Por favor, complete todos los campos.',
            });
        }
    });
});
