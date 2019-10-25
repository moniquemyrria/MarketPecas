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

function alterarDadosCliente($db, $usuario){

    $notificacao = null;
    if ($usuario['oferta_app'] == 'SIM'){
        $notificacao = 'S';
    }
    if ($usuario['oferta_app'] == 'NÃO'){
        $notificacao = 'N';
    }


    $str = $db->prepare(
        "UPDATE usuario SET senha = :senha
        where id = :id
    ");
    $str->bindParam("id", $usuario["idUsuario"]);
    $str->bindParam("senha", $usuario["senha"]);
    $str->execute();

    $strr = $db->prepare(
        "UPDATE cliente SET oferta_app = :ofertaApp
        where id_usuario = :id
    ");
    $strr->bindParam("id", $usuario["idUsuario"]);
    $strr->bindParam("ofertaApp", $notificacao);
    $strr->execute();

    return;
}

function validaDadosCliente($db, $idUsuario){

    $str = $db->prepare(
        "SELECT c.id as idCliente, u.id as idUsuario, u.email, u.tipo_pessoa, u.ativo from usuario u with(nolock)
        inner join cliente c with(nolock) on (c.id_usuario = u.id)
        where u.id = :id
    ");
    $str->bindParam("id", $idUsuario);
    $str->execute();
    return $str->fetchAll();
}
