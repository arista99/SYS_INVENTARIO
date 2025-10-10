$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosDeskLap").DataTable({
    ajax: {
      url: "ListaDeskLap",
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
                            data-fecha_fin_garantia="${row.fecha_inicio_garantia}"
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
      documento: $("#documento").val(),
      centro: $("#centro").val(),
      categoria: $("#categoria").val(),
      fabricante: $("#fabricante").val(),
      modelo: $("#modelo").val(),
      proveedor: $("#proveedor").val(),
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
    $("#edit_ethernet").val(btn.data("mac_ethernet"));
    $("#edit_wireless").val(btn.data("mac_wireless"));
    $("#edit_ip").val(btn.data("ip"));
    $("#edit_part").val(btn.data("numero_part"));

    // Guarda los valores en variables temporales
    cargarSede(btn.data("sede"));
    cargarUsuario(btn.data("usuario"));
    cargarCategoria(btn.data("categoria"));
    cargarCentro(btn.data("centro_costo"));
    cargarArea(btn.data("area"));
    cargarFabricante(btn.data("fabricante"));
    cargarProveedor(btn.data("proveedor"));
    cargarCondicion( btn.data("condicion"));
    cargarEstado(btn.data("estado"));
    cargarModelo(btn.data("modelo"));
    cargarDocumento( btn.data("documento"));

    // Mostrar el modal primero
    $("#modalEditarDeskLap").modal("show");
  });

  //Actualizar ActivoPC
  $("#modalEditarDeskLap").on("submit", function (e) {
    e.preventDefault();

   // Obtener los datos del formulario
    var formData = {
      id: $("#id").val(),
      edit_equipo: $("#equipo").val(),
      edit_serie: $("#serie").val(),
      edit_part: $("#part").val(),
      edit_procesador: $("#procesador").val(),
      edit_disco: $("#disco").val(),
      edit_memoria: $("#memoria").val(),
      edit_fecha_compra: $("#fecha_compra").val(),
      edit_ip: $("#ip").val(),
      edit_documento: $("#documento").val(),
      edit_centro: $("#centro").val(),
      edit_categoria: $("#categoria").val(),
      edit_fabricante: $("#fabricante").val(),
      edit_modelo: $("#modelo").val(),
      edit_proveedor: $("#proveedor").val(),
      edit_condicion: $("#condicion").val(),
      edit_estado: $("#estado").val(),
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
