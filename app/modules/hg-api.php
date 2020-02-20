<?php

// Classe para consumir qqr item HG_API
class HG_API
{
    // atributos privados para tratamento e star da key  (CONTROLE)
    private $key        = null;
    private $error      = false;    

    // construtor para iniciar quando for passar a $key da conexao vai iniciar a classe
    function __construct($key = null)
    {
        // verificar se foi enviada ou nao se esta vazia ou nao, se nao estivar atriuir a $key usando $this
        if (!empty($key)) $this->key = $key; 
    }

    // funcao generica para API , conteudo na URL p devolver em Json (Generica)

    // endpoint é usando antes do ?key 
    // params é os parametros da URL 
    function request ( $endpoint = '', $params = array() ){
        $uri = "https://api.hgbrasil.com/" . $endpoint . "?key=" . $this->$key . "&format=json";

        //se for necessario outros parametros 
        //@ diretiva se der erro ignora 
        if (is_array($params)) {

            foreach ($params as $key => $value) {
                if(empty($value)) continue;
                $uri .= $key . '=' . urlencode($value) . '&';
            }
            $uri        = substr($uri, 0, -1);
            $response   = @file_get_contents($uri);
            $this->error = false; 
            return json_decode($response, true);

        } else {

            $this->error = true;
            return false;
        }
    }

    // funcao p retornar o atributo erro p verificar na tela 

    function is_error(){
        return $this->error;
    }


    // função mais especifica para o Dollar (Especifica) 

    function dollar_quotation(){
        $data = $this->request('finance/quotations'); 

        if(!empty($data) && is_array($data['results']['currencies']['USD'])){
            $this->error = false; 
            return $data['results']['currencies']['USD'];
        } else {
            $this->error = true;
            return false;
        }
    }
}


?>