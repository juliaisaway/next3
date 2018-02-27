/*
 * Delete Overlay - Next
 *---------------------------------------------------------------
 *
 * Função Javascript para confirmação de exclusão no Banco de Dados
 * e envio para o controlador correspondente.
 *
 */

function DeleteBox($linha) {

    // Retorna todas as informações necessárias para o Ajax
    var line = $linha.closest('div[data-action]'),
        title = $linha.parent().parent().find('.table_label').html(),
        type = line.attr('data-type'),
        action = line.attr('data-action'),
        desc = line.attr('data-desc');

    // Constrói a mensagem de confirmação
    var message_title = "Deseja realmente deletar " + desc + " \"" + title+ "\" ?",
        message_body = "<div class='options-form'>";
        message_body += "<input id='teste' class='active_button action_delete' type='button' value=' Sim ' />";
        message_body += "<input class='light_button cancel' type='button' value='Cancelar' />";
        message_body += "</div>";

    // Chama a função de Overlay via objeto da biblioteca e abre o Overlay
    o.OverlayMessage(message_title, message_body);

    $('.action_delete').click(function () {

        // Insere o cursor de espera no DOM
        lib.wait();

        // Insere os valores necessários na array que irá ser enviada para o back-end
        var $param_name = type,
            data = {};
            data[$param_name + '_delete'] = true;
            data[$param_name + '_id'] = $linha.parent().parent().attr('data-id');

        // Construtor Ajax
        $.post(action, data, function(data){
            if(data === 'OK') {
                o.overlayClose();
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }
            else {
                wait(false);
                o.OverlayMessage('Erro', data);
            }
        });

    });

}

// Abrir Overlay para confirmação de exclusão da imagem e envia para o Controlador
$('.close, .action_button.delete').each(function() {

    var el = $(this);

    el.click(function(e){

        // Previne qualquer função padrão do HTML
        e.preventDefault();
        e.stopImmediatePropagation();

        // Retorna a função
        return new DeleteBox($(this));
    });

});