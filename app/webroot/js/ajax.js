$(document).ready(function() {

    $( "#btn" ).click(function(){

        $.get(
            "news/getDateTime",
            null,
            function(data){

                var retorno = jQuery.parseJSON( data );

                if( retorno.success ){
                   alert(retorno.html.uf);
                   alert(retorno.html.logradouro);
                   $("#data_hora").html(retorno.html);


                }
            }
        );
    });

});