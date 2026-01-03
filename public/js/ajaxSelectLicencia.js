function cargarCategoria(selectedId = null, selectedValue = null) {
  $.ajax({
    url: "listaCategoriaLicencia",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_categoria");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        // Si no hay valor, muestra el placeholder
        select.append(`<option disabled selected>Seleccionar Fabricante</option>`);
      } else {
        // Si hay un valor, muéstralo como la opción actual
        select.append(
          `<option value="${selectedId}" selected>${selectedValue} - Opción actual</option>`
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centro de fabricante:", error);
    },
  });
}

function cargarFabricante(selectedValue = null) {
  $.ajax({
    url: "listaFabricanteEdit",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_fabricante");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
      select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      }

      data.forEach((fabricantes) => {
        const isSelected = selectedValue === fabricantes.fabricante;
        const optionText = isSelected
          ? `${fabricantes.fabricante} - Opción actual`
          : fabricantes.fabricante;

        select.append(
          `<option value="${fabricantes.id}" ${
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

function cargarProveedor(selectedValue = null) {
  $.ajax({
    url: "listaProveedores",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_proveedor");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
      select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      }

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

function normalizeValue(v) {
  if (v === null || v === undefined) return null;

  // si viene como string "null", "undefined" o vacío
  if (typeof v === "string") {
    const s = v.trim().toLowerCase();
    if (s === "" || s === "null" || s === "undefined") return null;
  }
  return v;
}

function cargarDocumento(selectedId =null,selectedValue = null) {
  // Normalizar valores recibidos
  selectedId = normalizeValue(selectedId);
  selectedValue = normalizeValue(selectedValue);

  $.ajax({
    url: "listaDocumentosEdit",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_documento");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (selectedValue == null || selectedId == null) {
        select.append(
          `<option disabled selected>Seleccionar Documento</option>`
        );
      }else {
        // Si hay un valor, muéstralo como la opción actual
        select.append(
          `<option value="${selectedId}" selected>${selectedValue} - Opción actual</option>`
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centro de documento:", error);
    },
  });
}