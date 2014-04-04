<?php


class NewsController extends AppController{

    public function index(){}

    public function getDateTime($cep = 38700254){

        $this->layout = 'ajax';

        $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');
        if(!$resultado){
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
        }
        // pega o resultado do webservice e implementa ela em uma string
        parse_str($resultado, $retorno);

        // codifica strings do array para UTF-8 pois o json da como NULL strings não codificadas
        foreach( $retorno as $key => $value){
            $retorno[$key] = utf8_encode($retorno[$key]);
        }

        $this->set('date',$retorno);

    }


}