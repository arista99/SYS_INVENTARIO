function cargarTipoEntrega(selectedValue = null) {
  $.ajax({
    url: "listarEntregas",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_tipo_entrega");
      select.empty();

      // Mostrar la opción actual arriba como solo lectura
      if (selectedValue) {
        select.append(`
            <option value="" selected disabled>${selectedValue} - Opción actual</option>
          `);
      }

      // Filtrar
      const opcionesPermitidas = ["Devolución Completa", "Reasignación"];

      data.forEach((entregas) => {
        if (opcionesPermitidas.includes(entregas.entrega)) {
          select.append(
            `<option value="${entregas.id}">${entregas.entrega}</option>`
          );
        }
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando tipo de entrega:", error);
    },
  });
}
