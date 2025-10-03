window.addEventListener("DOMContentLoaded", () => {
    // Iniciar DataTable de Area
    var tabla = $("#tablaDatosFabricante").DataTable({
      ajax: {
        url: "vistaFabricante",
        type: "POST",
        // data: function (d) {
        //   d.area = $("#area").val();
        // },
      },
      columns: [
        { data: "fabricante" },
        {
          data: "id",
          render: function (data, type, row) {
            if (id_perfil == 2) {
              return `
                              <button class="btn btn-sm btn-warning btnEditar"
                              data-id="${row.id}"
                              data-fabricante="${row.fabricante}">
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

      // Registrar Fabricante
  $("#saveInfoButtonFabricante").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      fabricante: $("#fabricante").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarFabricante", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Fabricante",
            timer: 1500,
            showConfirmButton: false,
          }).then(function () {
            $("#modalCrearFabricante").modal("hide"); // Cerrar el modal
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
    $("#tablaDatosFabricante").on("click", ".btnEditar", function () {
      let btn = $(this);
  
      $("#id").val(btn.data("id"));
      $("#edit_fabricante").val(btn.data("fabricante"));
  
      $("#modalEditarFabricante").modal("show"); // Bootstrap 4/5
    });

    //Actualizar fabricante
   $("#formEditarFabricante").on("submit", function (e) {
    e.preventDefault();

    // console.log(formData);
    $.ajax({
      url: "actualizarFabricante",
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

          $("#modalEditarFabricante").modal("hide");
          $("#tablaDatosFabricante").DataTable().ajax.reload(null, false);
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
   $("#tablaDatosFabricante").on("click", ".btnEliminar", function () {
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
        $.post("eliminarFabricante", { id }, function () {
          Swal.fire("¡Eliminado!", "El fabricante ha sido eliminado correctamente.", "success");
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el fabricante.",
            "error"
          );
        });
      }
    });
  });
});  