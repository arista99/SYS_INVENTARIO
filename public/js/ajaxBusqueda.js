
    // Activar DataTables
    $('#tablaUsuarios, #tablaCelulares, #tablaDeskLap','#tablaAccesorios').DataTable({
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

    // Seleccionar accesorios
    $(document).on('click', '.seleccionar-accesorio', function(){
        $('#id_accesorio').val($(this).data('id'));
        $('#info_accesorio').val($(this).data('info'));
        $('#modalAccesorios').modal('hide');
    });

    
    // Seleccionar licencias
    $(document).on('click', '.seleccionar-licencia', function(){
        $('#id_licencia').val($(this).data('id'));
        $('#info_licencia').val($(this).data('info'));
        $('#modalLicencias').modal('hide');
    });