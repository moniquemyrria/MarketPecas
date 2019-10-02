<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';

$app->post('/usuario', function ($request, $response, $args) {
    $modelUsuario = $request->getParsedBody();
    $usuario = cadastrarUsuario($this->db, $modelUsuario[0]);
    return $this->response->withJson($usuario);
});

$app->get('/pesquisaUsuarioId/{id}', function ($request, $response, $args) {
    $usuario = pesquisaUsuarioId($this->db, $args['id']);
    return $this->response->withJson($usuario);
});

$app->post('/consultaEmailDuplicado', function ($request, $response, $args) {
    $modelEmail = $request->getParsedBody();
    $qtdeDuplicidade = consultaEmailDuplicado($this->db, $modelEmail);

    if (intval($qtdeDuplicidade) >= 1){
        $result = array();
        $resultItem = array(
            "duplicidade" => $qtdeDuplicidade ,
            "mensagem" => "Este E-mail já está sendo utilizado por outro usuário."
        );
        array_push($result,$resultItem);
        return $this->response->withJson($result);
    }else{
        return $this->response->withJson(0);
    }

});

$app->post('/validaUsuario', function ($request, $response, $args) {
    $modelUsuario = $request->getParsedBody();
    $usuario = validaUsuario($this->db, $modelUsuario);
    $result = array();
    if (count($usuario) > 0){
        $resultItem = array(
            "usuario" => $usuario,
            "mensagem" => "Olá, Bem vindo (a) ao MarketPeças."
        );
    }else{
        $resultItem = array(
            "usuario" => [],
            "mensagem" => "E-mail ou senha incorretos. Usuário não localizado."
        );
    }
    
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});


