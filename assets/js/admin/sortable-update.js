/*
 *---------------------------------------------------------------
 * Sortable Update
 *---------------------------------------------------------------
 *
 * Função Javascript para atualização no banco de dados a ordenação
 * dos elementos baseados em drag-and-drop via jQueryUI Sortable.
 *
 */

$(function() {

    // Retorna os elementos ordenáveis
    var $sort = $('.sortable'),
        action = $sort.attr('data-action');

    // Inicializa o jQueryUI Sortable
    $sort.sortable({
        placeholder: "ui-state-highlight",
        helper:'clone',
        update:function(event,ui){

            // A ordem é salva em uma array
            var order = [];

            // Retorna cada elemento possível, com exceção do separador de marcação
            $sort.children(":not(.ui-state-highlight)").each(function(){
                order.push($(this).children().attr('data-id'));
            });

            // Envia a ordenação da Array por Ajax até o controlador
            $.ajax({
                type        : 'POST',
                url         : action,
                data        : {'galleryimg_order':order, 'do':'order'},
                success     : function(data){
                    lib.wait(false);
                    if(data != 'OK'){
                        $sort.sortable( "option", "revert", true );
                        o.overlayOpen("Erro ao salvar ordem de imagens: "+data);
                    }
                }
            });

        }
    });

    // Previne que qualquer elemento possa ser interagido enquanto esativer arrastando os itens
    $sort.disableSelection();

});