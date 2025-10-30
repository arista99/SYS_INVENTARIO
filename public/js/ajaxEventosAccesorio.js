window.addEventListener("DOMContentLoaded", () => {
  // Iniciar DataTable de Area
  var tabla = $("#tablaDatosAccesorio").DataTable({
    ajax: {
      url: "findAccesorio",
      type: "POST",
      data: function (d) {
        d.accesorio = $("#accesorio").val();
      },
    },
    columns: [
      { data: "nombre" },
      { data: "ns" },
      { data: "condicion" },
      { data: "estado" },
      { data: "proveedor" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                              <button class="btn btn-sm btn-warning btnEditar"
                              data-id="${row.id}"
                              data-nombre="${row.nombre}"
                              data-ns="${row.ns}"
                              data-categoria="${row.categoria}"
                              data-fabricante="${row.fabricante}"
                              data-condicion="${row.condicion}"
                              data-estado="${row.estado}"
                              data-proveedor="${row.proveedor}">
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
        visible: id_perfil == 1, // solo mostrar si rol es == 1 (Administrador)
        searchable: false,
      },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
  });

  // Registrar area
  $("#btn-registrar-accesorio").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      nombre: $("#nombre").val(),
      serie: $("#serie").val(),
      categoria: $("#categoria").val(),
      fabricante: $("#fabricante").val(),
      proveedor: $("#proveedor").val(),
      documento: $("#documento").val(),
      condicion: $("#condicion").val(),
      estado: $("#estado").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarAccesorio", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se realizo el registro correctamente",
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
  $("#tablaDatosAccesorio").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_nombre").val(btn.data("nombre"));
    $("#edit_serie").val(btn.data("ns"));

    // Guarda los valores en variables temporales
    cargarCategoria(btn.data("categoria"));
    cargarFabricante(btn.data("fabricante"));
    cargarCondicion(btn.data("condicion"));
    cargarEstado(btn.data("estado"));
    cargarProveedor(btn.data("proveedor"));
    cargarDocumento(btn.data("documento"));

    $("#modalEditarAccesorio").modal("show"); // Bootstrap 4/5
  });
});
