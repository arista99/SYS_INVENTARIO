window.addEventListener("DOMContentLoaded", () => {
    // Iniciar DataTable de Area
    var tabla = $("#tablaDatosModelo").DataTable({
      ajax: {
        url: "vistaModelo",
        type: "POST",
        // data: function (d) {
        //   d.area = $("#area").val();
        // },
      },
      columns: [
        { data: "modelo" },
        {
          data: "id",
          render: function (data, type, row) {
            if (id_perfil == 2) {
              return `
                              <button class="btn btn-sm btn-warning btnEditar"
                              data-id="${row.id}"
                              data-modelo="${row.modelo}">
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
          targets: 1,
          visible: id_perfil == 1, // solo mostrar si rol es == 1 (Administrador)
          searchable: false,
        },
      ],
    });

    // Registrar Modelo
  $("#saveInfoButtonModelo").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      modelo: $("#modelo").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarModelo", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Modelo",
            timer: 1500,
            showConfirmButton: false,
          }).then(function () {
            $("#modalCrearModelo").modal("hide"); // Cerrar el modal
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
  $("#tablaDatosModelo").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_modelo").val(btn.data("modelo"));

    $("#modalEditarModelo").modal("show"); // Bootstrap 4/5
  });

  //Actualizar Modelo
  $("#formEditarModelo").on("submit", function (e) {
    e.preventDefault();

    // console.log(formData);
    $.ajax({
      url: "actualizarModelo",
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

          $("#modalEditarModelo").modal("hide");
          $("#tablaDatosModelo").DataTable().ajax.reload(null, false);
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
  $("#tablaDatosModelo").on("click", ".btnEliminar", function () {
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
        $.post("eliminarModelo", { id }, function () {
          Swal.fire("¡Eliminado!", "El modelo ha sido eliminado correctamente.", "success");
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el modelo.",
            "error"
          );
        });
      }
    });
  });
});  