
function cargarCentrosCosto(selectedValue = null) {
  $.ajax({
    url: "listaCentro",
    type: "GET",
    dataType: "json",
    success: function(data) {
      let select = $("#edit_centro_costo");
      select.empty();
      select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);

      data.forEach((centro) => {
        select.append(`<option value="${centro.id}">${centro.centro_costo}</option>`);
      });

      if (selectedValue) {
        
        // Selecciona automáticamente el valor del usuario
        setTimeout(() => select.val(selectedValue), 100); // esperar DOM update
        // select.append(`<option disabled selected>${selectedValue}</option>`);
      }
    },
    error: function(xhr, status, error) {
      console.error("Error cargando centros de costo:", error);
    }
  });
}
  
  function cargarSede(selectedValue = null) {
    $.ajax({
      url: "listaSede",
      type: "GET",
      dataType: "json",
      success: function(data) {
        let select = $("#edit_sede");
        select.empty();
        select.append(`<option disabled selected>Seleccionar Sede</option>`);
        data.forEach((sede) => {
          select.append(`<option value="${sede.id}">${sede.sede}</option>`);
        });
        if (selectedValue) select.val(selectedValue);
      }
    });
  }
  
  function cargarPerfil(selectedValue = null) {
    $.ajax({
      url: "listaPerfil",
      type: "GET",
      dataType: "json",
      success: function(data) {
        let select = $("#edit_perfil");
        select.empty();
        select.append(`<option disabled selected>Seleccionar Perfil</option>`);
        data.forEach((perfil) => {
          select.append(`<option value="${perfil.id}">${perfil.perfil}</option>`);
        });
        if (selectedValue) select.val(selectedValue);
      }
    });
  }
  
  function cargarArea(selectedValue = null) {
    $.ajax({
      url: "listaArea",
      type: "GET",
      dataType: "json",
      success: function(data) {
        let select = $("#edit_area");
        select.empty();
        select.append(`<option disabled selected>Seleccionar Área</option>`);
        data.forEach((area) => {
          select.append(`<option value="${area.id}">${area.area}</option>`);
        });
        if (selectedValue) select.val(selectedValue);
      }
    });
  }
  