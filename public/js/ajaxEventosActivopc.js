$(document).ready(function(){
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
});