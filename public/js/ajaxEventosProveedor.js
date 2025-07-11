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

  // Registrar Proveedor

  $("#btn-registrar-proveedor").click(function(event){
    event.preventDefault();

    var formData = {
      proveedor: $("#proveedor").val(),
      direccion: $("#direccion").val(),
      contacto: $("#contacto").val(),
      correo: $("#correo").val(),
      telefono: $("#telefono").val(),
      filtrarProducto: $("#filtrarProducto").val(),
      filtrarDocumento: $("#filtrarDocumento").val(),
    };
    
    // console.log(formData);
    $.ajax({
      url: "registrarProveedor",
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (r){
        if (r.success) {
         Swal.fire({
            icon: "success",
            title: "Se creo Proveedor",
            timer: 1500,
            showConfirButton: false,
         }).then(function () {
            location.reload(); // Recargar la página
            $("#formCrearProveedor")[0].reset();
         });
        }else{
          alert("Error: "+ r.message);
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

  //Actualizar Proveedor
  $("#formEditarProveedor").on("submit", function (e) {
    e.preventDefault();

    // console.log(formData);
    $.ajax({
      url: "actualizarProveedor",
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

          $("#modalEditarProveedor").modal("hide");
          $("#tablaDatosProveedor").DataTable().ajax.reload(null, false);
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

  // Acciones de eliminar
  $("#tablaDatosProveedor").on("click", ".btnEliminar", function () {
    const id = $(this).data("id");

    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("eliminarProveedor", { id }, function () {
          Swal.fire(
            "¡Eliminado!",
            "El Proveedor ha sido eliminado correctamente.",
            "success"
          );
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el proveedor.",
            "error"
          );
        });
      }
    });
  });
});
