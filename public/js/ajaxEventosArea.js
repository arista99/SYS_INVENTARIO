window.addEventListener("DOMContentLoaded", () => {
    // Iniciar DataTable de Area

    var table = $("#tablaDatosArea").DataTable({
        ajax: {
            url: "vistaArea",
            type: "POST",
            data: function (d) {
                d.area = $("#area").val();
            },
        },
        columns : [
            { data: "area"},
            {
                data: "id",
                render: function(data, type, row){
                    if(id_perfil == 2){
                        return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.id}"
                            data-area="${row.area}">
                            ✏️
                            </button>
                            <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.id}">🗑️</button>
                        `;
                    } else {
                        return "";
                    }
                },
            },
        ],
        columnDefs: [
            {
                targets: 1,
                visible: id_perfil == 2, // solo mostrar si rol es == 2
                searchable: false,
            },
        ],
    });

    // Botón Buscar
    // $("#btnBuscarArea").click(function () {
    //     tabla.ajax.reload();
    // });

    // Registrar area
    $("#saveInfoButtonArea").click(function (event) {
        event.preventDefault();

        // Obtener los datos del formulario
        var formData = {
            area: $("#area").val(),
        };

        console.log(formData);

        // Realizar la solicitud AJAX
        // $.ajax({
        //     url: "registrarArea", // Cambia a la URL de tu controlador
        //     method: "POST",
        //     data: formData,
        //     dataType: "json",
        //     success: function (response) {
        //         // Verificar si la solicitud fue exitosa
        //         if (response.success) {
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Se creo Area',
        //                 timer: 1500,
        //                 showConfirButton: false,
        //             }).then(function () {
        //                 $("#modalCrearArea").modal("hide"); // Cerrar el modal
        //                 location.reload(); // Recargar la página
        //             });

        //         } else {
        //             alert("Error: " + response.message); // Mostrar el mensaje de error del servidor
        //         }
        //     },
        //     error: function (xhr, status, error) {
        //         // Manejar errores de la solicitud AJAX
        //         console.error("Error en la solicitud AJAX:", error);
        //         console.error("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta en la consola
        //         alert(
        //             "Ocurrió un error al procesar la solicitud. Por favor, intenta nuevamente."
        //         );
        //     },
        // });
    });
});