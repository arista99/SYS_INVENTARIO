$(document).ready(function () {
  // Inicializar DataTable

  var tabla = $("#tablaDatosUsuario").DataTable({
    ajax: {
      url: "vistaUsuario",
      type: "POST",
      data: function (d) {
        d.nombre = $("#nombre").val();
      },
    },
    columns: [
      { data: "usuario" },
      { data: "usuario_red" },
      { data: "centro_costo" },
      { data: "email" },
      { data: "sede" },
      { data: "perfil" },
      { data: "area" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 2) {
            return `
                <button class="btn btn-sm btn-warning btnEditar"
                  data-id="${row.id}"
                  data-usuario="${row.usuario}"
                  data-usuario_red="${row.usuario_red}"
                  data-centro_costo="${row.centro_costo}"
                  data-email="${row.email}"
                  data-sede="${row.sede}"
                  data-perfil="${row.perfil}"
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
        targets: 7,
        visible: id_perfil == 2, // solo mostrar si rol == 2
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarUsuario").click(function () {
    tabla.ajax.reload();
  });

  // Evento click para llenar el modal de edición
  $("#tablaDatosUsuario").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_usuario").val(btn.data("usuario"));
    $("#edit_usu_red").val(btn.data("usuario_red"));
    $("#edit_email").val(btn.data("email"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarCentrosCosto(btn.data("centro_costo"));
    cargarSede(btn.data("sede"));
    cargarPerfil(btn.data("perfil"));
    cargarArea(btn.data("area"));

    $("#modalEditarUsuario").modal("show"); // Bootstrap 4/5
  });

  //Actualizar edificio
  $("#updateInfoButtonUsuario").on("submit", function (e) {
    // e.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id: $("#id").val(),
      edit_usuario: $("#edit_usuario").val(),
      edit_usu_red: $("#edit_usu_red").val(),
      edit_centro_costo: $("#edit_centro_costo").val(),
      edit_email: $("#edit_email").val(),
      edit_sede: $("#edit_sede").val(),
      edit_perfil: $("#edit_perfil").val(),
      edit_area: $("#edit_area").val(),
    };

    console.log(formData);
    // $.ajax({
    //   url: "actualizarUsuario",
    //   type: "POST",
    //   data: formData,
    //   success: function (response) {
    //     // const res = JSON.parse(response);
    //     if (response.success) {
    //       Swal.fire({
    //         icon: "success",
    //         title: "Actualizado correctamente",
    //         showConfirmButton: false,
    //         timer: 1500,
    //       });

    //       $("#modalEditarUsuario").modal("hide");

    //       // 🔁 Recarga la tabla
    //       $("#tablaDatosUsuario").DataTable().ajax.reload(null, false);
    //     } else {
    //       Swal.fire({
    //         icon: "error",
    //         title: "Error",
    //         text: res.message,
    //       });
    //     }
    //   },
    //   error: function (xhr, status, error) {
    //     // Manejar errores de la solicitud AJAX
    //     console.error("Error en la solicitud AJAX:", error);
    //     console.error("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta en la consola
    //     alert(
    //       "Ocurrió un error al procesar la solicitud. Por favor, intenta nuevamente."
    //     );
    //   },
    // });
  });
});
