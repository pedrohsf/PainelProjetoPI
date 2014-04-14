<?php

    /*
     * Classe criada para o intuito de cadastrar endereços
     * no qual vai ser usado somente um parâmetro para o cadastro um array com as informações
     */
    class ValidaCadastroEnderecosController extends AppController{


        public $uses = array('State','City','Neighborhood','Address');


        private function mergeState($data){
            $name = $data['name'];
            $acronym = $data['acronym'];

            $state = $this->State->find('first',array('conditions'=>array('State.name'=> $name, 'State.acronym' => $acronym)));

            if($state == null){
                $dataSave = array('State'=>array(
                    'name' => $name,
                    'acronym' => $acronym
                ));
                $this->State->save($dataSave);

            }
            // retorna id do estado
            return $this->State->find('first',array('conditions'=>array('State.name'=> $name, 'State.acronym' => $acronym)))['State']['id'];

        }


        private function mergeCity($data,$stateId){
            $name = $data['name'];

            $city = $this->City->find('first',array('conditions'=>array('City.name'=> $name, 'City.state_id' => $stateId)));

            if($city == null){
                $dataSave = array('City'=>array(
                    'name' => $name,
                    'state_id' => $stateId
                ));

                $this->City->save($dataSave);


            }
            // retorna id da cidade
            return $this->City->find('first',array('conditions'=>array('City.name'=> $name, 'City.state_id' => $stateId)))['City']['id'];

        }


        private function mergeNeighborhood($data,$idCity){
            $name = $data['name'];

            $neighborhood = $this->Neighborhood->find('first',array('conditions'=>array('Neighborhood.name'=> $name, 'Neighborhood.city_id' => $idCity)));

            if($neighborhood == null){
                $dataSave = array('Neighborhood'=>array(
                    'name' => $name,
                    'city_id' => $idCity
                ));
                $this->Neighborhood->save($dataSave);

            }
            // retorna id do bairro
            return $this->Neighborhood->find('first',array('conditions'=>array('Neighborhood.name'=> $name, 'Neighborhood.city_id' => $idCity)))['Neighborhood']['id'];

        }

        /*
         * Função principal que a partir dela é cadastrado estado, cidade e bairro caso não existam.
         */
        public function mergeAddresses($data){

            $cep = $data['Address']['cep'];
            $street = $data['Address']['street'];
            $number = $data['Address']['number'];
            $complement = $data['Address']['complement'];
            // basicamente um atributo derivado de pesquisa em várias outras tabelas do banco
            $neightborhood_id = $this->mergeNeighborhood(
                $data['Neighborhood'],
                $this->mergeCity( // functionque retorna id da cidade  , cadastrando se não existir
                    $data['City'],
                    $this->mergeState($data['State']) // função que retorna id do estado , cadastrando se não existir
                )
            );
            $address = $this->Address->find('first',array('conditions'=>array('Address.cep'=>$cep,'Address.street'=>$street,'Address.number'=>$number,'Address.complement'=>$complement,'Address.neighborhood_id'=>$neightborhood_id)));

            $dataSave = array('Address'=>array(
                'cep'=> $cep,
                'street'=> $street,
                'number'=> $number,
                'complement'=> $complement,
                'neighborhood_id'=> $neightborhood_id
            ));

            if(empty($address) OR $address == null){
                $this->Address->Save($dataSave);
            }


            return $this->Address->find('first',array('conditions'=>array('Address.cep'=>$cep,'Address.street'=>$street,'Address.number'=>$number,'Address.complement'=>$complement,'Address.neighborhood_id'=>$neightborhood_id)))['Address']['id'];

        }

    }