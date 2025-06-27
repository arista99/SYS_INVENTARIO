$(document).ready(function () {
  // Inicializar DataTable de Usuario

  var tabla = $("#tablaDatosUsuario").DataTable({
    ajax: {
      url: "vistaUsuario",
      type: "POST",
      data: function (d) {
        d.nombre = $("#nombre").val();
      },
    },
    columns: [
      { data: "usuario" },
      { data: "usuario_red" },
      { data: "centro_costo" },
      { data: "email" },
      { data: "sede" },
      { data: "perfil" },
      { data: "area" },
      {
        data: "id",
        render: function (data, type, row) {
          if (id_perfil == 2) {
            return `
                <button class="btn btn-sm btn-warning btnEditar"
                  data-id="${row.id}"
                  data-usuario="${row.usuario}"
                  data-usuario_red="${row.usuario_red}"
                  data-centro_costo="${row.centro_costo}"
                  data-email="${row.email}"
                  data-sede="${row.sede}"
                  data-perfil="${row.perfil}"
                  data-area="${row.area}">
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
  $("#btnBuscarUsuario").click(function () {
    tabla.ajax.reload();
  });

  // Evento click para llenar el modal de edición
  $("#tablaDatosUsuario").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#id").val(btn.data("id"));
    $("#edit_usuario").val(btn.data("usuario"));
    $("#edit_usu_red").val(btn.data("usuario_red"));
    $("#edit_email").val(btn.data("email"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarCentrosCosto(btn.data("centro_costo"));
    cargarSede(btn.data("sede"));
    cargarPerfil(btn.data("perfil"));
    cargarArea(btn.data("area"));

    $("#modalEditarUsuario").modal("show"); // Bootstrap 4/5
  });

  //Actualizar edificio
  $("#formEditarUsuario").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    // var formData = {
    //   id: $("#id").val(),
    //   edit_usuario: $("#edit_usuario").val(),
    //   edit_usu_red: $("#edit_usu_red").val(),
    //   edit_centro_costo: $("#edit_centro_costo").val(),
    //   edit_email: $("#edit_email").val(),
    //   edit_sede: $("#edit_sede").val(),
    //   edit_perfil: $("#edit_perfil").val(),
    //   edit_area: $("#edit_area").val(),
    // };

    // console.log(formData);
    $.ajax({
      url: "actualizarUsuario",
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

          $("#modalEditarUsuario").modal("hide");
          $("#tablaDatosUsuario").DataTable().ajax.reload(null, false);
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
  $("#tablaDatosUsuario").on("click", ".btnEliminar", function () {
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
        $.post("EliminarUsuarios", { id }, function () {
          Swal.fire(
            "¡Eliminado!",
            "El Usuario ha sido eliminado.",
            "success"
          );
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el usuario.",
            "error"
          );
        });
      }
    });
  });
});
