$(document).ready(function () {
  // Iniciar DataTable de Licencia
  var tabla = $("#tablaDatosLicencia").DataTable({
    ajax: {
      url: "findLicencia",
      type: "POST",
      data: function (d) {
        d.licencia = $("#licencia").val();
      },
    },
    columns: [
      { data: "software" },
      { data: "version" },
      { data: "cantidad_total" },
      { data: "cantidad_disponible" },
      { data: "tipo" },
      { data: "proveedor" },
      { data: "fecha_inicio_licencia" },
      { data: "fecha_fin_licencia" },
      {
        data: "id",
        className: "text-center",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                                <button class="btn btn-sm btn-warning btnEditar mx-auto d-block"
                                data-id="${row.id}"
                                data-software="${row.software}"
                                data-version="${row.version}"
                                data-cantidad_total="${row.cantidad_total}"
                                data-cantidad_disponible="${row.cantidad_disponible}"
                                data-tipo="${row.tipo}"
                                data-fecha_inicio_licencia="${row.fecha_inicio_licencia}"
                                data-fecha_fin_licencia="${row.fecha_fin_licencia}"
                                data-proveedor="${row.proveedor}"
                                data-id_documento="${row.id_documento}"
                                data-titulo="${row.titulo}"
                                data-id_categoria="${row.id_categoria}"
                                data-categoria="${row.categoria}"
                                data-id_fabricante="${row.id_fabricante}"
                                data-fabricante="${row.fabricante}">
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
        targets: 8,
        visible: id_perfil == 1, // solo mostrar si rol es == 1 (Administrador)
        searchable: false,
      },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
  });
  
  //<button class="btn btn-sm btn-danger btnEliminar" data-id="${row.id}">🗑️</button>
  // Registrar Licencia
  $("#btn-registrar-licencia").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      software: $("#software").val(),
      version: $("#version").val(),
      cantidad: $("#cantidad").val(),
      disponible: $("#disponible").val(),
      tipo: $("#tipo").val(),
      fecha_inicio_licencia: $("#fecha_inicio_licencia").val(),
      fecha_fin_licencia: $("#fecha_fin_licencia").val(),
      proveedor: $("#proveedor").val(),
      documento: $("#documento").val(),
      categoria: $("#categoria").val(),
      fabricante: $("#fabricante").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarLicencia", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Licencia",
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
  $("#tablaDatosLicencia").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_software").val(btn.data("software"));
    $("#edit_version").val(btn.data("version"));
    $("#edit_cantidad").val(btn.data("cantidad_total"));
    $("#edit_disponible").val(btn.data("cantidad_disponible"));
    $("#edit_tipo").val(btn.data("tipo"));
    $("#edit_fecha_inicio_licencia").val(btn.data("fecha_inicio_licencia"));
    $("#edit_fecha_fin_licencia").val(btn.data("fecha_fin_licencia"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarProveedor(btn.data("proveedor"));
    cargarDocumento(btn.data("id_documento"),btn.data("titulo"));
    cargarCategoria(btn.data("id_categoria"),btn.data("categoria"));
    cargarFabricante(btn.data("fabricante"));

    $("#modalEditarLicencia").modal("show"); // Bootstrap 4/5
  });

  //Actualizar Documento
  $("#formEditarLicencia").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
      var formData = {
        ip: $("#ip").val(),
        software: $("#software").val(),
        version: $("#version").val(),
        cantidad: $("#cantidad").val(),
        disponible: $("#disponible").val(),
        tipo: $("#tipo").val(),
        fecha_inicio_licencia: $("#fecha_inicio_licencia").val(),
        fecha_fin_licencia: $("#fecha_fin_licencia").val(),
        proveedor: $("#proveedor").val(),
        documento: $("#documento").val(),
        categoria: $("#categoria").val(),
        fabricante: $("#fabricante").val(),
      };

    // console.log(formData);
    $.ajax({
      url: "actualizarLicencia",
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

          $("#modalEditarLicencia").modal("hide");
          $("#tablaDatosLicencia").DataTable().ajax.reload(null, false);
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
