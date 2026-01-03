function cargarMantenimiento(selectedValue = null) {
  $.ajax({
    url: "listarMantenimiento",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_mantenimiento");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        select.append(
          `<option disabled selected>Seleccionar Mantenimiento</option>`
        );
      }

      data.forEach((mantenimientos) => {
        const isSelected = selectedValue === mantenimientos.tipo;
        const optionText = isSelected
          ? `${mantenimientos.tipo} - Opción actual`
          : mantenimientos.tipo;

        select.append(
          `<option value="${mantenimientos.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando tipo de mantenimiento:", error);
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

function cargarUsuario(selectedValue = null) {
  $.ajax({
    url: "listaUsuarios",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_usuario");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        select.append(
          `<option disabled selected>Seleccionar Usuario</option>`
        );
      }

      data.forEach((usuarios) => {
        const isSelected = selectedValue === usuarios.nombre;
        const optionText = isSelected
          ? `${usuarios.nombre} - Opción actual`
          : usuarios.nombre;

        select.append(
          `<option value="${usuarios.id}" ${
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

function cargarEstado(selectedValue = null) {
  $.ajax({
    url: "ListarEstadosMantenimiento",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_estado");
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