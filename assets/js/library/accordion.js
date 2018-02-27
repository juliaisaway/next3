/*
 * Next Accordion
 *---------------------------------------------------------------
 *
 * Biblioteca Javascript de criação de Accordions no site
 *
 */

function Accordion() {

    this.AccordionConstruct = AccordionConstruct;
    this.AccordionBinding = AccordionBinding;

    /**
     * Inicializa o Accordion no site
     * @constructor
     */
    function AccordionConstruct(){

        var obj = $('.accordion'),
            title = obj.find('.title');

        title.append('<i class="fas fa-caret-down"></i>');

        title.click(function(){

            var el = $(this);

            if(!$(this).hasClass('ativo')) {
                a.AccordionBinding(obj, el);
            }

        });

    }

    /**
     * Abre o Accordion
     * @param obj Accordion
     * @param el
     * @constructor
     */
    function AccordionBinding(obj, el) {
        obj.find('.title').removeClass('ativo');
        obj.find('.content').slideUp();
        obj.find('i').removeClass('rotate');
        el.next().slideToggle();
        el.find('i').addClass('rotate');
        el.addClass('ativo');
    }

}