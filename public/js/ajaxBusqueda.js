
    // Activar DataTables
    $('#tablaUsuarios, #tablaCelulares, #tablaDeskLap').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    // Seleccionar usuario
    $(document).on('click', '.seleccionar-usuario', function(){
        const id = $(this).data('id');
        const nombre = $(this).data('nombre');
        $('#id_usuario').val(id);
        $('#nombre_usuario').val(nombre);
        $('#modalUsuarios').modal('hide');
    });

    // Seleccionar celular
    $(document).on('click', '.seleccionar-celular', function(){
        const id = $(this).data('id');
        const info = $(this).data('info');
        $('#id_celular').val(id);
        $('#info_celular').val(info);
        $('#modalCelulares').modal('hide');
    });

    // Seleccionar desktop/laptop
    $(document).on('click', '.seleccionar-desklap', function(){
        const id = $(this).data('id');
        const info = $(this).data('info');
        $('#id_desklap').val(id);
        $('#info_desklap').val(info);
        $('#modalDeskLap').modal('hide');
    });

