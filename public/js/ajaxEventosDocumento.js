$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosDocumento").DataTable({
    ajax: {
      url: "vistaDocumento",
      type: "POST",
      data: function (d) {
        d.documento = $("#documento").val();
      },
    },
    columns: [
      { data: "documento" },
      { data: "adjunto" },
      { data: "fecha_registro" },
      { data: "fecha_ini" },
      { data: "fecha_fin" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 2) {
            return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.id}"
                            data-documento="${row.documento}"
                            data-adjunto="${row.adjunto}"
                            data-fecha_inicio="${row.fecha_inicio}"
                            data-fecha_termino="${row.fecha_termino}">
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
        targets: 5,
        visible: id_perfil == 2, // solo mostrar si rol es == 2
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarDocumento").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Documento
  $("#btn-registrar-documento").click(function (event) {
    event.preventDefault();

    // Obtener el formulario
    var form = $("#formCrearDocumento")[0];
    var formData = new FormData(form);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarDocumento", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Documento",
            timer: 1500,
            showConfirmButton: false,
          }).then(function () {
            location.reload(); // Recargar la página
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