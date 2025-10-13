// Cuando cambia la categoría
$('#categoria').on('change', function(){
    var id_categoria = $(this).val();
    // console.log("Cambio categoría: ", id_categoria);
    $.ajax({
        url: 'listaFabricante', 
        type: 'POST',
        dataType: 'json',
        data: { dato_mandar_servidor: id_categoria },
        success: function(fabricantes){
            // Limpiamos selects dependientes
            $('#fabricante').html('<option selected disabled>Seleccionar Fabricante</option>');
            $('#modelo').html('<option selected disabled>Seleccionar Modelo</option>');

            // Recorremos fabricantes y llenamos el select
            $.each(fabricantes, function(i, item){
                $('#fabricante').append('<option value="'+item.id+'">'+item.fabricante.toUpperCase()+'</option>');
            });
        },
        error: function(xhr, status, error){
            console.error("Error AJAX listaFabricante:", error);
        }
    });
});

// Cuando cambia el fabricante
$('#fabricante').on('change', function(){
    var id_fabricante = $(this).val();
    // console.log("Cambio fabricante: ", id_fabricante);
    $.ajax({
        url: 'listaModelo',
        type: 'POST',
        dataType: 'json',
        data: { dato_mandar_servidor: id_fabricante },
        success: function(modelos){
            // Limpiamos selects dependientes
            $('#modelo').html('<option selected disabled>Seleccionar Modelo</option>');

            $.each(modelos, function(i, item){
                $('#modelo').append('<option value="'+item.id+'">'+item.modelo.toUpperCase()+'</option>');
            });
        },
        error: function(xhr, status, error){
            console.error("Error AJAX listaModelo:", error);
        }
    });
});

// Cuando cambia el proveedor
$('#proveedor').on('change', function(){
    var id_proveedor = $(this).val();
    // console.log("Cambio fabricante: ", id_fabricante);
    $.ajax({
        url: 'listaDocumentos',
        type: 'POST',
        dataType: 'json',
        data: { dato_mandar_servidor: id_proveedor },
        success: function(documentos){
            // Limpiamos selects dependientes
            $('#documento').html('<option selected disabled>Seleccionar Documento</option>');

            $.each(documentos, function(i, item){
                $('#documento').append('<option value="'+item.id+'">'+item.documento.toUpperCase()+'</option>');
            });
        },
        error: function(xhr, status, error){
            console.error("Error AJAX listaDocumento:", error);
        }
    });
});