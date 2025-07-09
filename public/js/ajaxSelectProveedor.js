function cargarProducto(selectedValue = null) {
    $.ajax({
      url: "listaProducto",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_producto");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        // if (!selectedValue) {
        //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
        // }
  
        data.forEach((producto) => {
          const isSelected = selectedValue === producto.producto;
          const optionText = isSelected
            ? `${producto.producto} - Opción actual`
            : producto.producto;
  
          select.append(
            `<option value="${producto.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando producto:", error);
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
        // if(!selectedValue) {
        // select.append(`<option disabled selected>Seleccionar Área</option>`);
        //}
  
        data.forEach((documento) => {
          const isSelected = selectedValue === documento.documento;
          const optionText = isSelected
            ? `${documento.documento} - Opción Actual`
            : documento.documento;
  
          select.append(
            `<option value="${documento.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando documento:", error);
      },
    });
  }