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
                    // Quando encontra o endereço seta todos os campos
                   enderecamaneto = retorno.html;
                   $("#idRua").val(enderecamaneto.tipo_logradouro+" "+enderecamaneto.logradouro);
                   $("#idBairro").val(enderecamaneto.bairro);
                   $("#idCidade").val(enderecamaneto.cidade);
                   $("#idEstado").val(enderecamaneto.uf_nome);
                   $("#idEstadoSigla").val(enderecamaneto.uf);
                   if(enderecamaneto.resultado == 0){
                       alert("Digite um CEP Válido, o cep "+$("#UserCep").val()+ " não foi encontrado");
                       $("#UserCep").focus();
                   }
                }
            }
        ).fail(function(){

                alert("Não foi possível buscar este CEP, provavelmente por falha no serviço, por favor entre em contato com a administração.");
            })
            .done(function(){
                $( "#botaoBuscaEndereco").removeAttr('disabled','disabled');
            });


    });




});
