/*
 *---------------------------------------------------------------
 * Next Overlay
 *---------------------------------------------------------------
 *
 * Biblioteca Javascript de criação de Overlays no site
 *
 */

function Overlay(){

    this.OverlayConstruct = OverlayConstruct;
    this.overlayOpen = OverlayOpen;
    this.overlayClose = OverlayClose;
    this.OverlayMessage = OverlayMessage;

    /**
     * Inicializa o Overlay no site
     * @constructor
     */
    function OverlayConstruct(){
        $('body').append('<div id="overlay"><div id="overlay-box"></div></div>');

        overlay = $("#overlay");
        $overlayBox = $("#overlay-box");
        overlay.click(function(){o.overlayClose();});

        $overlayBox.click(function(e){e.stopPropagation();})
            .on('click', '.close, .cancel', function(){o.overlayClose();})
            .on('click', 'input', function(e){e.stopPropagation();});
    }

    /**
     * Abre o Overlay do site
     * @param content Conteúdo do Overlay
     * @constructor
     */
    function OverlayOpen(content){
        $('body').css('overflow', 'hidden');
        $("#overlay-box").removeClass().html(content);
        $("#overlay").css("display", "flex").hide().fadeIn();
    }

    /**
     * Fecha o Overlay ativo e volta a navegação do site
     * @constructor
     */
    function OverlayClose(){
        $('body').css('overflow', '');
        $("#overlay").fadeOut(function(){$overlayBox.html("");});
    }

    /**
     * Cria um Overlay com a mensagem a ser exibida no CMS
     * @param title Título da caixa de Overlay
     * @param body Mensagem principal do Overlay
     * @returns {string} Overlay aberto com a mensagem
     * @constructor
     */
    function OverlayMessage(title, body) {

        var msg = "<div class='content-block' style='margin: 0'>";
        msg += "<h3>" + title + "</h3>";
        msg += "<div class='content overlay'>";
        msg += body;
        msg += "</div>";
        msg += "</div>";

        return o.overlayOpen(msg);
    }

}