$(document).ready(function () {

    // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosMantenimiento").DataTable({
    ajax: {
      url: "findMantenimiento",
      type: "POST",
      data: function (d) {
        d.mantenimiento = $("#mantenimiento").val();
      },
    },
    columns: [
      { data: "nom_equipo" },
      { data: "tipo" },
      { data: "fecha_inicio" },
      { data: "fecha_fin" },
      { data: "nombre" },
      {
        data: "id",
        className: "text-center",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                    <button class="btn btn-sm btn-warning btnEditar"
                    data-id="${row.id}"
                    data-id_desk_lap="${row.id_desk_lap}"
                    data-nom_equipo="${row.nom_equipo}"
                    data-fabricante="${row.fabricante}"
                    data-modelo="${row.modelo}"
                    data-ns="${row.ns}"
                    data-tipo="${row.tipo}"
                    data-descripcion="${row.descripcion}"
                    data-observacion="${row.observacion}"
                    data-fecha_inicio="${row.fecha_inicio}"
                    data-fecha_fin="${row.fecha_fin}"
                    data-nombre="${row.nombre}"
                    data-proveedor="${row.proveedor}"
                    data-estado="${row.estado}">
                    ✏️
                    </button>
                    <a class="btn btn-sm btn-danger btnPDF" href="index.php?ruta=pdfMantenimiento&id=${row.id}" target="_blank">📄 PDF</a>
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
  // <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.id}">🗑️</button>
  //Botón Buscar
  $("#btnBuscarMantenimiento").click(function () {
    tabla.ajax.reload();
  });

  // Evento click para llenar el modal de edición
  $("#tablaDatosMantenimiento").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_id_desklap").val(btn.data("id_desk_lap"));
    $("#edit_info_desklap").val(
      btn.data("fabricante") +
        " - " +
        btn.data("modelo") +
        " - " +
        btn.data("ns")
    );
    $("#edit_descripcion").val(btn.data("descripcion"));
    $("#edit_observacion").val(btn.data("observacion"));
    $("#edit_fecha_inicio").val(btn.data("fecha_inicio"));
    $("#edit_fecha_fin").val(btn.data("fecha_fin"));

    cargarMantenimiento(btn.data("tipo"));
    cargarProveedor(btn.data("proveedor"));
    cargarUsuario(btn.data("nombre"));
    cargarEstado(btn.data("estado"));


    $("#modalEditarMantenimiento").modal("show"); // Bootstrap 4/5
  });

  // Registrar Mantenimiento
  $("#saveInfoButtonMantenimiento").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id_desklap: $("#id_desklap").val(),
      mantenimiento: $("#mantenimiento").val(),
      proveedor: $("#proveedor").val(),
      usuario: $("#usuario").val(),
      descripcion: $("#descripcion").val(),
      observacion: $("#observacion").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarMantenimiento", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se registro mantenimiento",
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

  $("#modalEditarMantenimiento").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
      var formData = {
      id: $("#id").val(),
      edit_id_desklap: $("#edit_id_desklap").val(),
      edit_mantenimiento: $("#edit_mantenimiento").val(),
      edit_proveedor: $("#edit_proveedor").val(),
      edit_estado: $("#edit_estado").val(),
      edit_usuario: $("#edit_usuario").val(),
      edit_fecha_fin: $("#edit_fecha_fin").val(),
      edit_descripcion: $("#edit_descripcion").val(),
      edit_observacion: $("#edit_observacion").val(),
    };

    // console.log(formData);

    $.ajax({
      url: "actualizarMantenimiento",
      type: "POST",
      data: formData,
      // data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: response.message || "Operación exitosa",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarMantenimiento").modal("hide");
          $("#tablaDatosMantenimiento").DataTable().ajax.reload(null, false);
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

  // Acciones de PDF
//  $("#tablaDatosMantenimiento").on("click", ".btnPDF", function () {
//   const id = $(this).data("id");

//   Swal.fire({
//     title: "¿Estás seguro?",
//     text: "¿Los datos son correctos?",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonText: "Sí, generar PDF",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       window.open("pdfMantenimiento/" + id, "_blank");
//     }
//   });
// });

});
