$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosAsignacionActivo").DataTable({
    ajax: {
      url: "findAsignacionActivo",
      type: "POST",
      data: function (d) {
        d.asignacion = $("#asignacion").val();
      },
    },
    columns: [
      { data: "nombre" },
      { data: "modelo" },
      { data: "numero" },
      { data: "nom_equipo" },
      { data: "entrega" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                    <button class="btn btn-sm btn-warning btnEditar"
                    data-id="${row.id}"
                    data-nombre="${row.nombre}"
                    data-numero="${row.numero}"
                    data-modelo="${row.modelo}"
                    data-nom_equipo="${row.nom_equipo}"
                    data-nom_equipo="${row.observacion}"
                    data-entrega="${row.entrega}">
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
  });
  // <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.id}">🗑️</button>
  //Botón Buscar
  $("#btnBuscarAsignacion").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Documento
  $("#btn-registrar-asignacion").click(function (event) {
    event.preventDefault();

   // Obtener los datos del formulario
        var formData = {
            id_usuario: $("#id_usuario").val(),
            id_celular: $("#id_celular").val(),
            id_desklap: $("#id_desklap").val(),
            tipo_entrega: $("#tipo_entrega").val(),
            observacion: $("#observacion").val(),
        };

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarAsignacionActivo", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se registro asignación",
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
  $("#tablaDatosAsignacionActivo").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_documento").val(btn.data("documento"));
    $("#edit_fecha_ini").val(btn.data("fecha_inicio"));
    $("#edit_fecha_fin").val(btn.data("fecha_termino"));

    $("#modalEditarDocumento").modal("show"); // Bootstrap 4/5
  });

  //Actualizar Documento
  // $("#formEditarDocumento").on("submit", function (e) {
  //   e.preventDefault();

  //   // console.log(formData);
  //   $.ajax({
  //     url: "actualizarDocumento",
  //     type: "POST",
  //     // data: formData,
  //     data: $(this).serialize(),
  //     dataType: "json", // ✅ Asegura que jQuery ya lo parsee
  //     success: function (response) {
  //       if (response.success) {
  //         Swal.fire({
  //           icon: "success",
  //           title: "Actualizado correctamente",
  //           showConfirmButton: false,
  //           timer: 1500,
  //         });

  //         $("#modalEditarDocumento").modal("hide");
  //         $("#tablaDatosDocumento").DataTable().ajax.reload(null, false);
  //       } else {
  //         Swal.fire({
  //           icon: "error",
  //           title: "Error",
  //           text: response.message || "Ocurrió un error al actualizar.",
  //         });
  //       }
  //     },
  //     error: function (xhr, status, error) {
  //       console.error("Error AJAX:", error);
  //       console.error("Respuesta:", xhr.responseText);

  //       Swal.fire({
  //         icon: "error",
  //         title: "Error de servidor",
  //         text: "No se pudo procesar la solicitud. Intenta más tarde.",
  //       });
  //     },
  //   });
  // });
});
