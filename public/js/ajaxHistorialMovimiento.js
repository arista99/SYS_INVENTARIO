$(document).ready(function () {
  // Inicializar DataTable de Usuario

  var tabla = $("#tablaDatosHistorialActivos").DataTable({
    ajax: {
      url: "findHistorialActivos",
      type: "POST",
      data: function (d) {
        d.asignacion = $("#asignacion").val();
      },
    },
    columns: [
      { data: "tipo_activo" },
      { data: "usuario_anterior" },
      { data: "usuario_nuevo" },
      { data: "entrega" },
      { data: "fecha_movimiento" },
      { data: "observacion" },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
  });

  // Botón Buscar
  $("#btnBuscarAsignacion").click(function () {
    tabla.ajax.reload();
  });

  var tabla = $("#tablaDatosHistorialAccesorios").DataTable({
    ajax: {
      url: "findHistorialAccesorios",
      type: "POST",
      data: function (d) {
        d.asignacion = $("#asignacion").val();
      },
    },
    columns: [
      { data: "id_accesorio" },
      { data: "usuario_anterior" },
      { data: "usuario_nuevo" },
      { data: "entrega" },
      { data: "fecha_movimiento" },
      { data: "observacion" },
    ],
    responsive: true,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
  });

  // Botón Buscar
  $("#btnBuscarAsignacionAccesorio").click(function () {
    tabla.ajax.reload();
  });
});
