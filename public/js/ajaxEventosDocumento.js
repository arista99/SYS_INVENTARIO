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
      { data: "titulo" },
      { data: "adjunto" },
      { data: "fecha_inicio" },
      { data: "fecha_termino" },
      { data: "producto" },
      { data: "proveedor" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 2) {
            return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.id}"
                            data-documento="${row.documento}"
                            data-adjunto="${row.adjunto}"
                            data-fecha_inicio="${row.fecha_ini}"
                            data-fecha_termino="${row.fecha_fin}">
                            ✏️
                            </button>
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
        visible: id_perfil == 1, // solo mostrar si rol es == 1 (Administrador)
        searchable: false,
      },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
  });
  // <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.id}">🗑️</button>
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

  // Evento click para llenar el modal de edición
  $("#tablaDatosDocumento").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_documento").val(btn.data("documento"));
    $("#edit_fecha_ini").val(btn.data("fecha_inicio"));
    $("#edit_fecha_fin").val(btn.data("fecha_termino"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarAdjunto(btn.data("adjunto"));

    $("#modalEditarDocumento").modal("show"); // Bootstrap 4/5
  });

  //Actualizar Documento
  $("#formEditarDocumento").on("submit", function (e) {
    e.preventDefault();

    // console.log(formData);
    $.ajax({
      url: "actualizarDocumento",
      type: "POST",
      // data: formData,
      data: $(this).serialize(),
      dataType: "json", // ✅ Asegura que jQuery ya lo parsee
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarDocumento").modal("hide");
          $("#tablaDatosDocumento").DataTable().ajax.reload(null, false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message || "Ocurrió un error al actualizar.",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX:", error);
        console.error("Respuesta:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "Error de servidor",
          text: "No se pudo procesar la solicitud. Intenta más tarde.",
        });
      },
    });
  });


});