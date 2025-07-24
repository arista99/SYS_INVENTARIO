function cargarSede(selectedValue = null) {
  $.ajax({
    url: "listaSede",
    type: "GET",
    dataType: "json",
    success: function (data) {
      const select = $("#edit_sede");

      // Destruir Select2 si ya estaba inicializado
      // if ($.fn.select2 && select.hasClass("select2-hidden-accessible")) {
      //   select.select2("destroy");
      // }

      // select.empty();

      // Agrega la opción por defecto correctamente (con value vacío)
      select.append(`<option value="" disabled ${!selectedValue ? "selected" : ""}>Seleccionar Sede</option>`);

      // Agrega las opciones dinámicamente
      data.forEach((sede) => {
        const isSelected = selectedValue === sede.sede;
        const optionText = isSelected
          ? `${sede.sede} - Opción actual`
          : sede.sede;

        select.append(
          `<option value="${sede.id}" ${isSelected ? "selected" : ""}>${optionText}</option>`
        );
      });

      // select.select2({
      //   placeholder: "Seleccionar sede...",
      //   width: "100%",
      //   allowClear: true,
      //   minimumResultsForSearch: 1,
      //   dropdownParent: $('#modalEditarActivoPC') // <- muy importante dentro de modales
      // });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando sede:", error);
    },
  });
}


function cargarUsuario(selectedValue = null) {
  $.ajax({
    url: "listaUsuario",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_usuario");
      select.empty();

       // Destruir Select2 si ya fue inicializado
      //  if ($.fn.select2 && select.hasClass("select2-hidden-accessible")) {
      //   select.select2("destroy");
      // }

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //   select.append(`<option disabled selected>Seleccionar Usuario</option>`);
      // }

      data.forEach((usuarios) => {
        const isSelected = selectedValue === usuarios.usuario;
        const optionText = isSelected
          ? `${usuarios.usuario} - Opción actual`
          : usuarios.usuario;

        select.append(
          `<option value="${usuarios.id}" ${isSelected ? "selected" : ""}>${optionText}</option>`
        );
      });

      // Reinicializar Select2 después de llenar las opciones
      select.select2({
        placeholder: "SELECCIONAR USUARIO",
        width: "100%",
        allowClear: true,
        minimumResultsForSearch: 1,
        dropdownParent: $('#modalEditarActivoPC') // <- muy importante dentro de modales
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando usuario:", error);
    },
  });
}

function cargarCategoria(selectedValue = null) {
  $.ajax({
    url: "listaCategoria",
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

function cargarCentro(selectedValue = null) {
  $.ajax({
    url: "listaCentro",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_centro");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        select.append(
          `<option disabled selected>Seleccionar Centro de Costo</option>`
        );
      }

      data.forEach((centros) => {
        const isSelected = selectedValue === centros.centro_costo;
        const optionText = isSelected
          ? `${centros.centro_costo} - Opción actual`
          : centros.centro_costo;

        select.append(
          `<option value="${centros.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centro de costo:", error);
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
      if (!selectedValue) {
        select.append(`<option disabled selected>Seleccionar Area</option>`);
      }

      data.forEach((areas) => {
        const isSelected = selectedValue === areas.area;
        const optionText = isSelected
          ? `${areas.area} - Opción actual`
          : areas.area;

        select.append(
          `<option value="${areas.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centro de area:", error);
    },
  });
}

function cargarFabricante(selectedValue = null) {
  $.ajax({
    url: "listaFabricante",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_fabricante");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        select.append(
          `<option disabled selected>Seleccionar Fabricante</option>`
        );
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
      console.error("Error cargando centro de fabricante:", error);
    },
  });
}

function cargarProveedor(selectedValue = null) {
  $.ajax({
    url: "listaProveedoresOP",
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

function cargarCondicion(selectedValue = null) {
  $.ajax({
    url: "listaCondiciones",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_condicion");
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

function cargarModelo(selectedValue = null) {
  $.ajax({
    url: "listaModelo",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_modelo");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      if (!selectedValue) {
        select.append(`<option disabled selected>Seleccionar Modelo</option>`);
      }

      data.forEach((modelos) => {
        const isSelected = selectedValue === modelos.modelo;
        const optionText = isSelected
          ? `${modelos.modelo} - Opción actual`
          : modelos.modelo;

        select.append(
          `<option value="${modelos.id}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando centro de modelo:", error);
    },
  });
}

function cargarDocumento(selectedValue = null) {
  $.ajax({
    url: "listaDocumentosOP",
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
      }

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
      console.error("Error cargando centro de documento:", error);
    },
  });
}
