$(document).ready(function() {


    $( "#botaoBuscaEndereco" ).click(function(){

        siteLocal =  "http://localhost/trabalho_pi/Endereco/getEndereco/" + $("#UserCep").val();

        $( "#botaoBuscaEndereco").attr('disabled','disabled');

        $.get(
            siteLocal,
            null,
            function(data){


                var retorno = jQuery.parseJSON( data );

                if( retorno.success ){
                   enderecamaneto = retorno.html;
                   $("#idRua").val(enderecamaneto.tipo_logradouro+" "+enderecamaneto.logradouro);
                   $("#idBairro").val(enderecamaneto.bairro);
                   $("#idCidade").val(enderecamaneto.cidade);
                   $("#idEstado").val(enderecamaneto.uf_nome);
                   $("#idEstadoSigla").val(enderecamaneto.uf);
                }
            }
        ).fail(function(){

                alert(JSON.stringify(this));
            })
            .done(function(){
                $( "#botaoBuscaEndereco").removeAttr('disabled','disabled');
            }).
            always(function(){



            });

    });

});