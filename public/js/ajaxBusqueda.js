
    // Activar DataTables
    $('#tablaUsuarios, #tablaCelulares, #tablaDeskLap').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    // Seleccionar usuario
    $(document).on('click', '.seleccionar-usuario', function(){
        $('#id_usuario').val($(this).data('id'));
        $('#nombre_usuario').val($(this).data('nombre'));
        $('#modalUsuarios').modal('hide');
    });

    // Seleccionar celular
    $(document).on('click', '.seleccionar-celular', function(){
        $('#id_celular').val($(this).data('id'));
        $('#info_celular').val($(this).data('info'));
        $('#modalCelulares').modal('hide');
    });

    // Seleccionar desktop/laptop
    $(document).on('click', '.seleccionar-desklap', function(){
        $('#id_desklap').val($(this).data('id'));
        $('#info_desklap').val($(this).data('info'));
        $('#modalDeskLap').modal('hide');
    });

