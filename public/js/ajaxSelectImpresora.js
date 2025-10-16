function cargarCategoria(selectedValue = null) {
    $.ajax({
      url: "listaCategoriaImpresora",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_categoria");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(
            `<option disabled selected>Seleccionar Categoria</option>`
          );
        }
  
        data.forEach((categorias) => {
          const isSelected = selectedValue === categorias.categoria;
          const optionText = isSelected
            ? `${categorias.categoria} - Opción actual`
            : categorias.categoria;
  
          select.append(
            `<option value="${categorias.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando categoria:", error);
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
          // Si no hay valor, muestra el placeholder
          select.append(`<option disabled selected>Seleccionar Fabricante</option>`);
        } else {
          // Si hay un valor, muéstralo como la opción actual
          select.append(
            `<option selected>${selectedValue} - Opción actual</option>`
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error cargando centro de fabricante:", error);
      },
    });
  }
  
  function cargarModelo(selectedValue = null) {
    $.ajax({
      url: "listaModeloEdit",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_modelo");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(`<option disabled selected>Seleccionar Modelo</option>`);
        }else {
          // Si hay un valor, muéstralo como la opción actual
          select.append(
            `<option selected>${selectedValue} - Opción actual</option>`
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error cargando centro de modelo:", error);
      },
    });
  }
  
  function cargarCondicion(selectedValue = null) {
    $.ajax({
      url: "listaCondiciones",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#condicion");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(
            `<option disabled selected>Seleccionar Condicion</option>`
          );
        }
  
        data.forEach((condiciones) => {
          const isSelected = selectedValue === condiciones.condicion;
          const optionText = isSelected
            ? `${condiciones.condicion} - Opción actual`
            : condiciones.condicion;
  
          select.append(
            `<option value="${condiciones.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando centro de condicion:", error);
      },
    });
  }
  
  function cargarEstado(selectedValue = null) {
    $.ajax({
      url: "listaEstado",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#estado");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(`<option disabled selected>Seleccionar Estado</option>`);
        }
  
        data.forEach((estados) => {
          const isSelected = selectedValue === estados.estado;
          const optionText = isSelected
            ? `${estados.estado} - Opción actual`
            : estados.estado;
  
          select.append(
            `<option value="${estados.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando centro de estado:", error);
      },
    });
  }
  
  function cargarProveedor(selectedValue = null) {
    $.ajax({
      url: "listaProveedores",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#proveedor");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(
            `<option disabled selected>Seleccionar Proveedor</option>`
          );
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
        console.error("Error cargando centro de proveedor:", error);
      },
    });
  }
  
  function cargarDocumento(selectedValue = null) {
    $.ajax({
      url: "listaDocumentosEdit",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_documento");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(
            `<option disabled selected>Seleccionar Documento</option>`
          );
        }else {
          // Si hay un valor, muéstralo como la opción actual
          select.append(
            `<option selected>${selectedValue} - Opción actual</option>`
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error cargando centro de documento:", error);
      },
    });
  }
  