document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registroForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que el formulario se envíe normalmente

        const formData = new FormData(this); // Crear un objeto FormData con los datos del formulario
        formData.append('metodo', 'registrarUsuario'); // Agregar el método para identificar la acción

        fetch('./app/controller/datos.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parsear la respuesta JSON
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: data.message,
                }).then(() => {
                    window.location.href = 'login.php'; // Redirigir al login
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                });
            }
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error en el servidor.',
            });
        });
    });
});
