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
    $("#edit_sede").val(btn.data("sede"));
    $("#edit_perfil").val(btn.data("perfil"));
    $("#edit_area").val(btn.data("area"));

    // Llenar el select y seleccionar el valor actual
    cargarCentrosCosto(btn.data("centro_costo"));

    $("#modalEditarUsuario").modal("show"); // Bootstrap 4/5
  });

});