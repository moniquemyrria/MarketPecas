<?php

function cadastrarContato($db, $contato){  
   
    $str = $db->prepare(
        "INSERT INTO CONTATO(
            telefone
            , whatsapp
            , facebook
        )
        VALUES(
            :telefone
            , :wapp
            , :fb
        )
     ");
   
    $str->bindParam("telefone", $contato["telefone"]);
    $str->bindParam("wapp", $contato["wapp"]);
    $str->bindParam("fb", $contato["fb"]);
   
    $str->execute();
    $idContato = $db->lastInsertid();

    $result = array();
    $resultItem = array(
        "contato" => $contato,
        "idContato" => $idContato,
    );
    array_push($result,$resultItem);
    
    return $result;
}



