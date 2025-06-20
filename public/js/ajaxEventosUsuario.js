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
                  data-id-centro_costo="${row.id_centro_costo}"
                  data-centro_costo="${row.centro_costo}"
                  data-email="${row.email}"
                  data-id-sede="${row.id_sede}"
                  data-sede="${row.sede}"
                  data-id-perfil="${row.id_perfil}"
                  data-perfil="${row.perfil}"
                  data-id-area="${row.id_area}"
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
    cargarCentrosCosto(btn.data("id-centro_costo"));
    cargarSede(btn.data("id-sede"));
    cargarPerfil(btn.data("id-perfil"));
    cargarArea(btn.data("id-area"));

    $("#modalEditarUsuario").modal("show"); // Bootstrap 4/5
  });

  //Actualizar edificio
  $("#formEditarUsuario").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "actualizarUsuario",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        const res = JSON.parse(response);

        if (res.success) {
          Swal.fire({
            icon: "success",
            title: "Actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarUsuario").modal("hide");

          // 🔁 Recarga la tabla
          $("#tablaDatosUsuario").DataTable().ajax.reload(null, false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: res.message,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo conectar con el servidor.",
        });
      },
    });
  });
});
