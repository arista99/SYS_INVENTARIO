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
          if (id == 2) {
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
        visible: id == 2, // solo mostrar si rol == 2
        searchable: false,
      },
    ],
  });
});
