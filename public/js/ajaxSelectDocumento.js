function cargarAdjunto(selectedValue = null) {
    $.ajax({
      url: "listaAdjunto",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_adjunto");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        // if (!selectedValue) {
        //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
        // }
  
        data.forEach((adjuntos) => {
          const isSelected = selectedValue === adjuntos.adjunto;
          const optionText = isSelected
            ? `${adjuntos.adjunto} - Opción actual`
            : adjuntos.adjunto;
  
          select.append(
            `<option value="${adjuntos.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando Adjunto:", error);
      },
    });
  }