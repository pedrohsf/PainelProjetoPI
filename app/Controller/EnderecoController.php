<?php


class EnderecoController extends AppController{



    public function getEndereco($cep = NULL){


        $this->layout = 'ajax';
        if(empty($cep) ){
            $cep = "66666-666";
        }
        $resultado = @file_get_contents('http://republicavirtual.com.br/web_cep.php?cep='.urlencode($cep).'&formato=query_string');

        if(!$resultado){
            $resultado = "&resultado=0&resultado_txt=erro+ao+buscar+cep";
        }

        // pega o resultado do webservice e implementa ela em uma string
        parse_str($resultado, $retorno);

        $this->swtichEstados($retorno);

        // codifica strings do array para UTF-8 pois o json da como NULL strings não codificadas
        foreach( $retorno as $key => $value){
            // não passar a key uf_nome para utf-8 pois ela já se encontra em utf-8, tirar esse if fara com que a string trave
            if(!($key === 'uf_nome'))
                $retorno[$key] = utf8_encode($retorno[$key]);
        }

        $this->set('date',$retorno);

    }


    private function swtichEstados(&$retorno){
        switch ($retorno['uf']){
            case 'AC':
                $retorno += array('uf_nome'=> 'Acre');
                break;
            case 'AL':
                $retorno += array('uf_nome'=> 'Alagoas');
                break;
            case 'AM':
                $retorno += array('uf_nome'=> 'Amazonas');
                break;
            case 'AP':
                $retorno += array('uf_nome'=> 'Amapá');
                break;
            case 'BA':
                $retorno += array('uf_nome'=> 'Bahia');
                break;
            case 'CE':
                $retorno += array('uf_nome'=> 'Ceará');
                break;
            case 'DF':
                $retorno += array('uf_nome'=> 'Distrito Federal');
                break;
            case 'ES':
                $retorno += array('uf_nome'=> 'Espírito Santo');
                break;
            case 'GO':
                $retorno += array('uf_nome'=> 'Goiás');
                break;
            case 'MA':
                $retorno += array('uf_nome'=> 'Maranhão');
                break;
            case 'MT':
                $retorno += array('uf_nome'=> 'Mato Grosso');
                break;
            case 'MS':
                $retorno += array('uf_nome'=> 'Mato Grosso do Sul');
                break;
            case 'MG':
                $retorno += array('uf_nome'=> 'Minas Gerais');
                break;
            case 'PR':
                $retorno += array('uf_nome'=> 'Paraná');
                break;
            case 'PB':
                $retorno += array('uf_nome'=> 'Paraíba');
                break;
            case 'PA':
                $retorno += array('uf_nome'=> 'Pará');
                break;
            case 'PE':
                $retorno += array('uf_nome'=> 'Pernambuco');
                break;
            case 'PI':
                $retorno += array('uf_nome'=> 'Piauí');
                break;
            case 'RJ':
                $retorno += array('uf_nome'=> 'Rio de Janeiro');
                break;
            case 'RN':
                $retorno += array('uf_nome'=> 'Rio Grande do Norte');
                break;
            case 'RS':
                $retorno += array('uf_nome'=> 'Rio Grande do Sul');
                break;
            case 'RO':
                $retorno += array('uf_nome'=> 'Rondonia');
                break;
            case 'RR':
                $retorno += array('uf_nome'=> 'Roraima');
                break;
            case 'SC':
                $retorno += array('uf_nome'=> 'Santa Catarina');
                break;
            case 'SE':
                $retorno += array('uf_nome'=> 'Sergipe');
                break;
            case 'SP':
                $retorno += array('uf_nome'=> 'São Paulo');
                break;
            case 'TO':
                $retorno += array('uf_nome'=> 'Tocantins');
                break;
            default:
                $retorno += array('uf_nome'=> '');
        }

    }

}