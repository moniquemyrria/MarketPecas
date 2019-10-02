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
