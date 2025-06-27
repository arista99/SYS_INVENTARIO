function cargarCentrosCosto(selectedValue = null) {
  $.ajax({
    url: "listaCentro",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_centro_costo");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((centro) => {
        const isSelected = selectedValue === centro.centro_costo;
        const optionText = isSelected
          ? `${centro.centro_costo} - Opción actual`
          : centro.centro_costo;

        select.append(
          `<option value="${centro.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centros de costo:", error);
    },
  });
}

function cargarSede(selectedValue = null) {
  $.ajax({
    url: "listaSede",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_sede");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if(!selectedValue) {
      // select.append(`<option disabled selected>Seleccionar Área</option>`);
      //}

      data.forEach((sede) => {
        const isSelected = selectedValue === sede.sede;
        const optionText = isSelected
          ? `${sede.sede} - Opción Actual`
          : sede.sede;

        select.append(
          `<option value="${sede.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centros de costo:", error);
    },
  });
}

function cargarPerfil(selectedValue = null) {
  $.ajax({
    url: "listaPerfil",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_perfil");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if(!selectedValue) {
      // select.append(`<option disabled selected>Seleccionar Área</option>`);
      //}

      data.forEach((perfil) => {
        const isSelected = selectedValue === perfil.perfil;
        const optionText = isSelected
          ? `${perfil.perfil} - Opción actual`
          : perfil.perfil;

        select.append(
          `<option value="${perfil.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centros de costo:", error);
    },
  });
}

function cargarArea(selectedValue = null) {
  $.ajax({
    url: "listaArea",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_area");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if(!selectedValue) {
      // select.append(`<option disabled selected>Seleccionar Área</option>`);
      //}

      data.forEach((area) => {
        const isSelected = selectedValue === area.area;
        const optionText = isSelected
          ? `${area.area} - Opción Actual`
          : area.area;

        select.append(
          `<option value="${area.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option> `
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centros de costo:", error);
    },
  });
}
