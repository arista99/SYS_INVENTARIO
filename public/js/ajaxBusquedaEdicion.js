
    // Activar DataTables
    $('#tablaUsuarios, #tablaCelulares, #tablaDeskLap').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    // Cuando se abre el modal de usuarios
    $('#modalUsuarios').on('show.bs.modal', function () {
        $('#modalEditarAsignacionActivo').addClass('slide-right');
    });

    // Cuando se cierra el modal de usuarios
    $('#modalUsuarios').on('hidden.bs.modal', function () {
        $('#modalEditarAsignacionActivo').removeClass('slide-right');
    });


    // Seleccionar usuario
    $(document).on('click', '.seleccionar-usuario', function(){
        $('#edit_id_usuario').val($(this).data('id'));
        $('#edit_nombre_usuario').val($(this).data('nombre'));
        $('#modalUsuarios').modal('hide');
    });

    // Seleccionar celular
    $(document).on('click', '.seleccionar-celular', function(){
        $('#edit_id_celular').val($(this).data('id'));
        $('#edit_info_celular').val($(this).data('info'));
        $('#modalCelulares').modal('hide');
    });

    // Seleccionar desktop/laptop
    $(document).on('click', '.seleccionar-desklap', function(){
        $('#edit_id_desklap').val($(this).data('id'));
        $('#edit_info_desklap').val($(this).data('info'));
        $('#modalDeskLap').modal('hide');
    });

