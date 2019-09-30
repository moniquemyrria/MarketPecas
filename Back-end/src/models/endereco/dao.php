<?php

function cadastrarEndereco($db, $endereco){  
   
    $str = $db->prepare(
        "INSERT INTO ENDERECO(
            logradouro
            , numero
            , bairro
            , cep
        )
        VALUES(
            :logradouro
            , :numero
            , :bairro
            , :cep
        )
     ");
   
    $str->bindParam("logradouro", $endereco["logradouro"]);
    $str->bindParam("numero", $endereco["num"]);
    $str->bindParam("bairro", $endereco["bairro"]);
    $str->bindParam("cep", $endereco["cep"]);
   
    $str->execute();
    $idEndereco = $db->lastInsertid();

    $result = array();
    $resultItem = array(
        "endereco" => $endereco,
        "idEndereco" => $idEndereco,
    );
    array_push($result,$resultItem);
    
    return $result;
}



