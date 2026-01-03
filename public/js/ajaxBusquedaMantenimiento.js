
    // Activar DataTables
    $('#tablaDeskLap').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
        }
    });

    // Cuando se abre el modal de desklap
    $('#modalDeskLap').on('show.bs.modal', function () {
        $('#modalEditarMantenimiento').addClass('slide-right');
    });

    // Cuando se cierra el modal de desklap
    $('#modalDeskLap').on('hidden.bs.modal', function () {
        $('#modalEditarMantenimiento').removeClass('slide-right');
    });

    // Seleccionar desktop/laptop
    $(document).on('click', '.seleccionar-desklap', function(){
        $('#edit_id_desklap').val($(this).data('id'));
        $('#edit_info_desklap').val($(this).data('info'));
        $('#modalDeskLap').modal('hide');
    });

