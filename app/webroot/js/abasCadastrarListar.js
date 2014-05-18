
window.onload = function(){

    var l = $(".btn-listar");
    var c = $(".btn-cadastrar");

    c.click(function(){
        $('.lista').fadeOut();
        $('.cadastro').fadeIn();
        l.removeClass('btn-info').addClass('btn-primary');
        c.removeClass('btn-primary').addClass('btn-info');
    });

    l.click(function(){
        $('.lista').fadeIn();
        $('.cadastro').fadeOut();
        l.removeClass('btn-primary').addClass('btn-info');
        c.removeClass('btn-info').addClass('btn-primary');
    });

    l.click();

}