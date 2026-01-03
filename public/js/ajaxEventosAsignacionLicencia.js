$(document).ready(function () {

   // Iniciar DataTable de Adjunto
  var tabla = $("#tablaDatosAsignacionLicencia").DataTable({
    ajax: {
      url: "findAsignacionLicencia",
      type: "POST",
      data: function (d) {
        d.asignacion = $("#asignacion").val();
      },
    },
    columns: [
      { data: "nom_equipo" },
      { data: "software" },
      { data: "version" },
      { data: "tipo" },
      { data: "fecha_asignacion" },
      {
        data: "id",
        className: "text-center",
        render: function (data, type, row) {
          if (id_perfil == 1) {
            return `
                    <button class="btn btn-sm btn-warning btnEditar"
                    data-id="${row.id}"
                    data-nom_equipo="${row.nom_equipo}"
                    data-software="${row.software}"
                    data-version="${row.version}"
                    data-tipo="${row.tipo}"
                    data-fecha_asignacion="${row.fecha_asignacion}">
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
  $("#btnBuscarAsignacion").click(function () {
    tabla.ajax.reload();
  });

  // Registrar Asignacion
  $("#saveInfoButtonAsignacionLicencia").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id_desklap: $("#id_desklap").val(),
      id_licencia: $("#id_licencia").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "registrarAsignacionLicencia", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se registro asignación",
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
});
