<?php

function cadastrarEmpresa($db, $empresa){

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

function verificaCheck($value){
    if ($value == true){
        return 'S';
    }
    if ($value == false){
        return 'N';
    }
}



