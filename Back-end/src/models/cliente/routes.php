<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';


$app->post('/cliente', function ($request, $response, $args) {
    $modelCliente = $request->getParsedBody();
    $cliente = cadastrarCliente($this->db, $modelCliente);
    $result = array();
    $resultItem = array(
        "cliente" => $cliente,
        "mensagem" => "Cadastro realizado com sucesso. Obrigada por escolher o MarketPlace. Você já pode realizar seu Login."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->put('/cliente', function ($request, $response, $args) {
    $modelUsuario = $request->getParsedBody();
    $usuario = alterarDadosCliente($this->db, $modelUsuario);
    $result = array();
    
    $resultItem = array(
        "mensagem" => "Seus dados do foram alterado com sucesso."
    );
    
    
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});