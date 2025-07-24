$(document).ready(function () {
  // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosActivoPC").DataTable({
    ajax: {
      url: "vistaActivoPC",
      type: "POST",
      data: function (d) {
        d.activopc = $("#activopc").val();
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
          if (id_perfil == 2) {
            return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.id}"
                            data-nom_equipo="${row.nom_equipo}"
                            data-ns="${row.ns}"
                            data-procesador="${row.procesador}"
                            data-disco="${row.disco}"
                            data-memoria="${row.memoria}"
                            data-sede="${row.sede}"
                            data-usuario="${row.usuario}"
                            data-categoria="${row.categoria}"
                            data-centro_costo="${row.centro_costo}"
                            data-area="${row.area}"
                            data-fabricante="${row.fabricante}"
                            data-proveedor="${row.proveedor}"
                            data-mac_ethernet="${row.mac_ethernet}"
                            data-mac_wireless="${row.mac_wireless}"
                            data-ip="${row.ip}"
                            data-condicion="${row.condicion}"
                            data-estado="${row.estado}"
                            data-modelo="${row.modelo}"
                            data-documento="${row.documento}"
                            data-numero_part="${row.numero_part}">
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
        visible: id_perfil == 2, // solo mostrar si rol es == 2
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarActivoPC").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Adjunto
  $("#btn-registrar-activoPC").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      equipo: $("#equipo").val(),
      serie: $("#serie").val(),
      part: $("#part").val(),
      procesador: $("#procesador").val(),
      disco: $("#disco").val(),
      memoria: $("#memoria").val(),
      ethernet: $("#ethernet").val(),
      wireless: $("#wireless").val(),
      ip: $("#ip").val(),
      usuario: $("#usuario").val(),
      sede: $("#sede").val(),
      categoria: $("#categoria").val(),
      centro: $("#centro").val(),
      area: $("#area").val(),
      fabricante: $("#fabricante").val(),
      proveedor: $("#proveedor").val(),
      condicion: $("#condicion").val(),
      estado: $("#estado").val(),
      modelo: $("#modelo").val(),
      documento: $("#documento").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarActivoPC", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Activo PC",
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
  $("#tablaDatosActivoPC").on("click", ".btnEditar", function () {
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
    const sede = btn.data("sede");
    const usuario = btn.data("usuario");
    const categoria = btn.data("categoria");
    const centro = btn.data("centro_costo");
    const area = btn.data("area");
    const fabricante = btn.data("fabricante");
    const proveedor = btn.data("proveedor");
    const condicion = btn.data("condicion");
    const estado = btn.data("estado");
    const modelo = btn.data("modelo");
    const documento = btn.data("documento");

    // Mostrar el modal primero
    $("#modalEditarActivoPC").modal("show");

    // Una vez visible, cargar los select2
    $("#modalEditarActivoPC").on("shown.bs.modal", function () {
      cargarSede(sede);
      cargarUsuario(usuario);
      cargarCategoria(categoria);
      cargarCentro(centro);
      cargarArea(area);
      cargarFabricante(fabricante);
      cargarProveedor(proveedor);
      cargarCondicion(condicion);
      cargarEstado(estado);
      cargarModelo(modelo);
      cargarDocumento(documento);
    });
  });
});
