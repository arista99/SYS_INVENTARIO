function cargarProveedor(selectedValue = null) {
  $.ajax({
    url: "listaProveedor",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_proveedor");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((proveedores) => {
        const isSelected = selectedValue === proveedores.proveedor;
        const optionText = isSelected
          ? `${proveedores.proveedor} - Opción actual`
          : proveedores.proveedor;

        select.append(
          `<option value="${proveedores.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando Proveedor:", error);
    },
  });
}

function cargarDocumento(selectedValue = null) {
  $.ajax({
    url: "listaDocumento",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_documento");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((documentos) => {
        const isSelected = selectedValue === documentos.documento;
        const optionText = isSelected
          ? `${documentos.documento} - Opción actual`
          : documentos.documento;

        select.append(
          `<option value="${documentos.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando Documento:", error);
    },
  });
}
