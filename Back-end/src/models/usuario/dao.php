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



