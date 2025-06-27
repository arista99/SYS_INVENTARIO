window.addEventListener("DOMContentLoaded", () => {

    $(document).ready(function () {
        $("#btn-registrar-usuario").click(function (event) {
            event.preventDefault();

            // Obtener los datos del formulario
            var formData = {
                usuarioRed: $("#usuarioRed").val(),
                usuario: $("#usuario").val(),
                filtrarSede: $("#filtrarSede").val(),
                contrasena: $("#contrasena").val(),
                filtrarCentro: $("#filtrarCentro").val(),
                filtrarArea: $("#filtrarArea").val(),
                correo: $("#correo").val(),
                filtrarPerfil: $("#filtrarPerfil").val(),
                cargo: $("#cargo").val(),
            };

            //console.log(formData);

            // Realizar la solicitud AJAX
            $.ajax({
                url: "registrarUsuario", // Cambia a la URL de tu controlador
                method: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    // Verificar si la solicitud fue exitosa
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se creo Usuario',
                            timer: 1500,
                            showConfirmButton: false,
                        }).then(function () {
                            location.reload(); // Recargar la página
                            $("#formCrearUsuario")[0].reset();
                        });
                    } else {
                        alert("Error: " + response.message); // Mostrar el mensaje de error del servidor
                    }
                },
                error: function (xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error("Error en la solicitud AJAX:", error);
                    console.error("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta en la consola
                    alert(
                        "Ocurrió un error al procesar la solicitud. Por favor, intenta nuevamente."
                    );
                },
            });
        });
    });
});