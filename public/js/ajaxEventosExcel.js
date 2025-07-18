$(document).ready(function () {
  $("#inputImportExcel").on("change", function () {
    let formData = new FormData();
    formData.append("archivoExcel", this.files[0]);

    $.ajax({
      url: "importarExcelActivoPC", // adaptado a tu ruta MVC
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        alert("Resultado: " + response);
      },
      error: function () {
        alert("Error al importar el archivo");
      },
    });
  });
});
