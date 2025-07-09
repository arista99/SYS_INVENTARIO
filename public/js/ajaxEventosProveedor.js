$(document).ready(function () {
  //Iniciar Data Table Proveedor
  var tabla = $("#tablaDatosProveedor").DataTable({
    ajax: {
      url: "vistaProveedor",
      type: "POST",
      data: function (d) {
        d.proveedor = $("#proveedor").val();
      },
    },
    columns: [
      { data: "proveedor" },
      { data: "direccion" },
      { data: "contacto" },
      { data: "email" },
      { data: "telefono" },
      { data: "producto" },
      { data: "documento" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 2) {
            return `
                <button class="btn btn-sm btn-warning btnEditar"
                  data-id="${row.id}"
                  data-proveedor="${row.proveedor}"
                  data-direccion="${row.direccion}"
                  data-contacto="${row.contacto}"
                  data-email="${row.email}"
                  data-telefono="${row.telefono}"
                  data-producto="${row.producto}"
                  data-documento="${row.documento}">
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
  $("#btnBuscarProveedor").click(function () {
    tabla.ajax.reload();
  });

// Evento click para llenar el modal de edición
$("#tablaDatosProveedor").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_proveedor").val(btn.data("proveedor"));
    $("#edit_direccion").val(btn.data("direccion"));
    $("#edit_contacto").val(btn.data("contacto"));
    $("#edit_email").val(btn.data("email"));
    $("#edit_telefono").val(btn.data("telefono"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarProducto(btn.data("producto"));
    cargarDocumento(btn.data("documento"));

    $("#modalEditarProveedor").modal("show"); // Bootstrap 4/5
    });

});
