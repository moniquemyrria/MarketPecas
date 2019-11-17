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

function listarContatosSMSOferta($db)
{
    $str = $db->prepare(
        "SELECT '+55'+ replace(replace(replace((co.telefone),'(',''),')',''),'-','') as PhoneNumber  from cliente c
        inner join contato co on (co.id = c.id_contato)
        where co.telefone is not null
        and c.oferta_app = 'S'
    ");
    $str->execute();
    return $str->fetchAll();
}

function listarContatosEmailOferta($db)
{
    $str = $db->prepare(
        "SELECT u.email, CONCAT(c.nome, ' ', c.sobrenome) as nome from cliente c
        inner join usuario u on (u.id = c.id_contato)
        where c.oferta_app = 'S'
    ");
    $str->execute();
    return $str->fetchAll();
}



