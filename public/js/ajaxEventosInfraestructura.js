window.addEventListener("DOMContentLoaded", () => {
    // Iniciar DataTable de Area
    var tabla = $("#tablaDatosInfraestructura").DataTable({
      ajax: {
        url: "findInfraestructura",
        type: "POST",
        data: function (d) {
          d.modelo = $("#modelo").val();
        },
      },
      columns: [
        { data: "modelo" },
        { data: "ip" },
        { data: "ns" },
        { data: "fecha_compra"},
        { data: "estado" },
        {
          data: "id",
          className: "text-center",
          render: function (data, type, row) {
            if (id_perfil == 1) {
              return `
                              <button class="btn btn-sm btn-warning btnEditar"
                              data-ip="${row.ip}"
                              data-ns="${row.ns}"
                              data-fecha_compra="${row.fecha_compra}"
                              data-fecha_instalacion="${row.fecha_instalacion}"
                              data-fecha_retiro="${row.fecha_retiro}"
                              data-categoria="${row.categoria}"
                              data-fabricante="${row.fabricante}"
                              data-modelo="${row.modelo}"
                              data-area="${row.area}"
                              data-sede="${row.sede}"
                              data-estado="${row.estado}"
                              data-condicion="${row.condicion}"
                              data-proveedor="${row.proveedor}"
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
    $("#btn-registrar-impresora").click(function (event) {
      event.preventDefault();
  
      // Obtener los datos del formulario
      var formData = {
        ip: $("#ip").val(),
        serie: $("#serie").val(),
        fecha_compra: $("#fecha_compra").val(),
        categoria: $("#categoria").val(),
        fabricante: $("#fabricante").val(),
        modelo: $("#modelo").val(),
        condicion: $("#condicion").val(),
        estado: $("#estado").val(),
        proveedor: $("#proveedor").val(),
        documento: $("#documento").val(),
      };
  
      // console.log(formData);
  
      // Realizar la solicitud AJAX
      $.ajax({
        url: "registrarImpresora", // Cambia a la URL de tu controlador
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
  
    //Evento click para llenar el modal de edición
    // $("#tablaDatosAccesorio").on("click", ".btnEditar", function () {
    //   let btn = $(this);
  
    //   $("#id").val(btn.data("id"));
    //   $("#edit_nombre").val(btn.data("nombre"));
    //   $("#edit_serie").val(btn.data("ns"));

    //   // Guarda los valores en variables temporales
    //   cargarCategoria(btn.data("categoria"));
    //   cargarFabricante(btn.data("fabricante"));
    //   cargarCondicion( btn.data("condicion"));
    //   cargarEstado(btn.data("estado"));
    //   cargarProveedor(btn.data("proveedor"));
    //   cargarDocumento( btn.data("documento"));
    
    //   $("#modalEditarAccesorio").modal("show"); // Bootstrap 4/5
    // });
});
  