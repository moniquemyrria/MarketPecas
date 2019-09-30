<?php

function cadastrarCliente($db, $cliente){

    $notificacao = null;
    if ($cliente['notificacao'] == 'SIM'){
        $notificacao = 'S';
    }
    if ($cliente['notificacao'] == 'NÃO'){
        $notificacao = 'N';
    }

    $str = $db->prepare(
        "INSERT INTO CLIENTE(
            oferta_app
            , id_usuario
            , nome
            , sobrenome
        )
        VALUES(
            :notificacao
            , :idUsuario
            , :nome
            , :sobrenome
        )
    ");
    $str->bindParam("notificacao", $notificacao);
    $str->bindParam("idUsuario", $cliente["idUsuario"]);
    $str->bindParam("nome", $cliente["nome"]);
    $str->bindParam("sobrenome", $cliente["sobrenome"]);
    $str->execute();
    
    return $cliente;
}



