
    // Activar DataTables
    $('#tablaUsuarios, #tablaDeskLap').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    // Cuando se abre el modal de usuarios
    $('#modalUsuarios').on('show.bs.modal', function () {
        $('#modalEditarAsignacionAccesorio').addClass('slide-right');
    });

    // Cuando se cierra el modal de usuarios
    $('#modalUsuarios').on('hidden.bs.modal', function () {
        $('#modalEditarAsignacionAccesorio').removeClass('slide-right');
    });

    // Cuando se abre el modal de desklap
    $('#modalAccesorios').on('show.bs.modal', function () {
        $('#modalEditarAsignacionAccesorio').addClass('slide-right');
    });

    // Cuando se cierra el modal de desklap
    $('#modalAccesorios').on('hidden.bs.modal', function () {
        $('#modalEditarAsignacionAccesorio').removeClass('slide-right');
    });

    // Seleccionar usuario
    $(document).on('click', '.seleccionar-usuario', function(){
        $('#edit_id_usuario').val($(this).data('id'));
        $('#edit_nombre_usuario').val($(this).data('nombre'));
        $('#modalUsuarios').modal('hide');
    });

    // Seleccionar desktop/laptop
    $(document).on('click', '.seleccionar-accesorio', function(){
        $('#edit_id_accesorio').val($(this).data('id'));
        $('#edit_info_accesorio').val($(this).data('info'));
        $('#modalAccesorios').modal('hide');
    });

