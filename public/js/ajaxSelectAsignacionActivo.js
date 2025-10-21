function cargarTipoEntrega(selectedValue = null) {
    $.ajax({
      url: "listarEntregas",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_tipo_entrega");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        if (!selectedValue) {
          select.append(`<option disabled selected>Seleccionar Tipo de Entrega</option>`);
        }
  
        data.forEach((entregas) => {
          const isSelected = selectedValue === entregas.entrega;
          const optionText = isSelected
            ? `${ entregas.entrega} - Opción actual`
            :  entregas.entrega;
  
          select.append(
            `<option value="${entregas.id}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando tipo de entrega:", error);
      },
    });
  }
  