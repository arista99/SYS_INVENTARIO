$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosAsignacionAccesorio").DataTable({
    ajax: {
      url: "findAsignacionAccesorio",
      type: "POST",
      data: function (d) {
        d.asignacion = $("#asignacion").val();
      },
    },
    columns: [
      { data: "nombre" },
      { data: "equipo" },
      { data: "observacion" },
      { data: "entrega" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                      <button class="btn btn-sm btn-warning btnEditar mx-auto d-block"
                      data-id="${row.id}"
                      data-id_usuario="${row.id_usuario}"
                      data-nombre="${row.nombre}"
                      data-id_accesorio="${row.id_accesorio}"
                      data-equipo="${row.equipo}"
                      data-observacion="${row.observacion}"
                      data-fecha_asignacion="${row.fecha_asignacion}"
                      data-id_entrega="${row.id_entrega}"
                      data-tipo_entrega="${row.entrega}">
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
        targets: 4,
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
  //Botón Buscar
  $("#btnBuscarAsignacion").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Asignacion
  $("#saveInfoButtonAsignacionAccesorio").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id_usuario: $("#id_usuario").val(),
      id_accesorio: $("#id_accesorio").val(),
      tipo_entrega: $("#tipo_entrega").val(),
      observacion: $("#observacion").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarAsignacionAccesorio", // Cambia a la URL de tu controlador
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
  $("#tablaDatosAsignacionAccesorio").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_id_usuario").val(btn.data("id_usuario"));
    $("#edit_nombre_usuario").val(btn.data("nombre"));
    $("#edit_id_accesorio").val(btn.data("id_accesorio"));
    $("#edit_info_accesorio").val(btn.data("equipo"));
    $("#edit_observacion").val(btn.data("observacion"));
    $("#edit_fecha_movimiento").val(btn.data("fecha_asignacion"));

    // Guarda los valores en variables temporales
    cargarTipoEntrega(btn.data("tipo_entrega"));

    $("#modalEditarAsignacionAccesorio").modal("show"); // Bootstrap 4/5
  });
});
