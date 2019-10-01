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


