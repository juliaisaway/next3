/*
 * Next Utilities
 *---------------------------------------------------------------
 *
 * Biblioteca Javascript com pequenas funções utilitárias do site.
 *
 */

function NextUtilities() {

    this.scrollTo = scrollTo;
    this.wait = wait;

    function scrollTo(el, target, adjust, speed){
        var pos, speed;
        adjust = ($.isNumeric(adjust))? adjust:0;
        pos = ($(target).length > 0)? $(target).offset().top:($.isNumeric(target))? target:0;
        speed = ($.isNumeric(speed))? speed:(speed == 'fast')?500:1500;
        pos = pos+adjust+el.scrollTop();
        el.animate({
            scrollTop: pos
        }, speed);
    }

    function wait(flag){
        flag = ($.type(flag) === "boolean")? flag:true;
        if(flag)
            $("body").addClass('wait');
        else
            $("body").removeClass('wait');
    }

}