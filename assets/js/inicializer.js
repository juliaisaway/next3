/*
 *---------------------------------------------------------------
 * Inicializador Next
 *---------------------------------------------------------------
 *
 * Arquivo principal de inicialização das principais funções JS do Site
 *
 */

// Inicializadores de classes"
var o = new Overlay(),
    lib = new NextUtilities();

$(function(){

    // Inicializa o Overlay no site
    o.OverlayConstruct();

    // Cria a função do botão de Subir para a página
    $('#scrolltotop').click(function(){
        lib.scrollTo($("#body"), 0);
        $(this).blur();
        return false;
    });

});

$(window).scroll(function(){
    if ($(this).scrollTop() > 100) {
        $('#scrolltotop').fadeIn();
    } else {
        $('#scrolltotop').fadeOut();
    }
});