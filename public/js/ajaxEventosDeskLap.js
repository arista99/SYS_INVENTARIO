$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosDeskLap").DataTable({
    ajax: {
      url: "findDeskopLaptop",
      type: "POST",
      data: function (d) {
        d.desklap = $("#desklap").val();
      },
    },
    columns: [
      { data: "nom_equipo" },
      { data: "ns" },
      { data: "procesador" },
      { data: "disco" },
      { data: "memoria" },
      { data: "numero_part" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.id}"
                            data-nom_equipo="${row.nom_equipo}"
                            data-ns="${row.ns}"
                            data-procesador="${row.procesador}"
                            data-disco="${row.disco}"
                            data-memoria="${row.memoria}"
                            data-ip="${row.ip}"
                            data-numero_part="${row.numero_part}"
                            data-fecha_compra="${row.fecha_compra}"
                            data-fecha_inicio_garantia="${row.fecha_inicio_garantia}"
                            data-fecha_fin_garantia="${row.fecha_fin_garantia}"
                            data-fecha_baja="${row.fecha_baja}"
                            data-proveedor="${row.proveedor}"
                            data-centro_costo="${row.centro_costo}"
                            data-condicion="${row.condicion}"
                            data-estado="${row.estado}"
                            data-categoria="${row.categoria}"
                            data-fabricante="${row.fabricante}"
                            data-modelo="${row.modelo}"
                            data-documento="${row.documento}"">
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
        targets: 6,
        visible: id_perfil == 1, // solo mostrar si rol es == 1 (Administrador)
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarDeskLap").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Adjunto
  $("#saveInfoButtonDeskLap").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      equipo: $("#equipo").val(),
      serie: $("#serie").val(),
      part: $("#part").val(),
      procesador: $("#procesador").val(),
      disco: $("#disco").val(),
      memoria: $("#memoria").val(),
      fecha_compra: $("#fecha_compra").val(),
      ip: $("#ip").val(),
      proveedor: $("#proveedor").val(),
      documento: $("#documento").val(),
      categoria: $("#categoria").val(),
      fabricante: $("#fabricante").val(),
      modelo: $("#modelo").val(),
      centro: $("#centro").val(),
      condicion: $("#condicion").val(),
      estado: $("#estado").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "RegistrarDeskLap", // Cambia a la URL de tu controlador
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
  $("#tablaDatosDeskLap").on("click", ".btnEditar", function () {
    let btn = $(this);

    // Llenar campos simples
    $("#id").val(btn.data("id"));
    $("#edit_equipo").val(btn.data("nom_equipo"));
    $("#edit_serie").val(btn.data("ns"));
    $("#edit_procesador").val(btn.data("procesador"));
    $("#edit_disco").val(btn.data("disco"));
    $("#edit_memoria").val(btn.data("memoria"));
    $("#edit_ip").val(btn.data("ip"));
    $("#edit_part").val(btn.data("numero_part"));
    $("#edit_fecha_compra").val(btn.data("fecha_compra"));
    $("#edit_fecha_baja").val(btn.data("fecha_baja"));
    $("#edit_fecha_inicio").val(btn.data("fecha_inicio_garantia"));
    $("#edit_fecha_fin").val(btn.data("fecha_fin_garantia"));

    // Guarda los valores en variables temporales
    cargarCategoria(btn.data("categoria"));
    cargarFabricante(btn.data("fabricante"));
    cargarModelo(btn.data("modelo"));
    cargarCentro(btn.data("centro_costo"));
    cargarProveedor(btn.data("proveedor"));
    cargarCondicion( btn.data("condicion"));
    cargarEstado(btn.data("estado"));
    cargarDocumento( btn.data("documento"));

    // Mostrar el modal
    $("#modalEditarDeskLap").modal("show");
  });

  //Actualizar ActivoPC
  $("#modalEditarDeskLap").on("submit", function (e) {
    e.preventDefault();

   // Obtener los datos del formulario
    var formData = {
      id: $("#id").val(),
      edit_equipo: $("#edit_equipo").val(),
      edit_serie: $("#edit_serie").val(),
      edit_part: $("#edit_part").val(),
      edit_procesador: $("#edit_procesador").val(),
      edit_disco: $("#edit_disco").val(),
      edit_memoria: $("#edit_memoria").val(),
      edit_fecha_compra: $("#edit_fecha_compra").val(),
      edit_fecha_baja: $("#edit_fecha_baja").val(),
      edit_fecha_inicio: $("#edit_fecha_inicio").val(),
      edit_fecha_fin: $("#edit_fecha_fin").val(),
      edit_ip: $("#edit_ip").val(),
      edit_proveedor: $("#edit_proveedor").val(),
      edit_documento: $("#edit_documento").val(),
      edit_categoria: $("#edit_categoria").val(),
      edit_fabricante: $("#edit_fabricante").val(),
      edit_modelo: $("#edit_modelo").val(),
      edit_centro: $("#edit_centro").val(),
      edit_condicion: $("#edit_condicion").val(),
      edit_estado: $("#edit_estado").val(),
    };

    // console.log(formData);

    $.ajax({
      url: "ActualizarDeskLap",
      type: "POST",
      data: formData,
      // data: $(this).serialize(),
      dataType: "json", // ✅ Asegura que jQuery ya lo parsee
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarDeskLap").modal("hide");
          $("#tablaDatosDeskLap").DataTable().ajax.reload(null, false);
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
