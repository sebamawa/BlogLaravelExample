/**
 * Codigo jquery para realizar request ajax para eliminar tag de la lista de tags
 * (en la view index.blade.php).
 * Ademas actualiza el total de tags en la view anterior y muestra mensaje de ok o error.
 */

$(document).ready(function(){
    $('#alert').hide(); //oculto div de alerta de mensajes
    $('.btn-delete-ajax').click(function(e){ //capto evento de click de eliminar tag con ajax
        e.preventDefault(); //detengo evento de click (reload pagina)
        if (!confirm("Está seguro de eliminar")) {
            return false;
        }
        //guardo url y fila de tabla de tags
        var row = $(this).parents('tr'); //busco padre tr del btn
        var form = $(this).parents('form') //obtengo padre form (solo para obtener su url)
        var url = form.attr('action');
        
        $('#alert').show(); //muestra div de alerta de mensajes

        //AJAX
        $.post(url, form.serialize(), function(result) { //form.serialize() pasa datos del form
            row.fadeOut(); //oculto fila seleccionada

            //muestro mensaje recibido como json desde el response de destroy() del contralador
            $('#tags_total').html(result.total);
            $('#alert').html(result.message);
        }).fail(function() {
            $('#alert').html('Algo salio mal');
        });
    });
});