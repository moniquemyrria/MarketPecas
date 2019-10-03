<?php

function cadastrarUsuario($db, $usuario){  
   
    $str = $db->prepare(
        "INSERT INTO USUARIO(
            email
            , senha
            , tipo_pessoa
            , ativo
        )
        VALUES(
            :email
            , :senha
            , :tipoPessoa
            , 'S'
        )
     ");
   
    $str->bindParam("email", $usuario["email"]);
    $str->bindParam("senha", $usuario["senha"]);
    $str->bindParam("tipoPessoa", $usuario["tipoPessoa"]);
    $str->execute();
    $idUsuario = $db->lastInsertid();

    $result = array();
    $resultItem = array(
        "usuario" => $usuario,
        "idUsuario" => $idUsuario,
    );
    array_push($result,$resultItem);
    
    return $result;
}

function consultaEmailDuplicado($db, $usuario){

    $str = $db->prepare(
        "SELECT COUNT(email) emailDuplicado 
        FROM usuario with(nolock)
        where email = :email");
    $str->bindParam("email", $usuario["email"]);
    $str->execute();
    $qtd = $str->fetchAll();
    $result = $qtd[0]['emailDuplicado'];

    return $result;
}

function validaUsuario($db, $usuario){

    $str = $db->prepare(
        "SELECT id, email, tipo_pessoa, ativo from usuario where email = :email and senha = :senha
    ");
    $str->bindParam("email", $usuario["email"]);
    $str->bindParam("senha", $usuario["senha"]);
    $str->execute();
    return $str->fetchAll();
}

function pesquisaUsuarioId($db, $id){
    $str = $db->prepare(
        "SELECT u.id as idUsuario, c.id as idCliente, u.*, c.* from cliente c with(nolock)
        inner join usuario u with(nolock) on (u.id = c.id_usuario)
        where u.id ='" .$id. "'
        and u.ativo = 'S'
    ");
    $str->execute();
    return $str->fetchAll();
}

function alterarUsuario($db, $usuario){

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
