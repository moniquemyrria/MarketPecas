<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';


$app->post('/empresa', function ($request, $response, $args) {
    $modelEmpresa = $request->getParsedBody();
    $empresa = cadastrarEmpresa($this->db, $modelEmpresa);
    $result = array();
    $resultItem = array(
        "empresa" => $empresa,
        "mensagem" => "Cadastro realizado com sucesso. Obrigada por escolher o MarketPlace. Você já pode realizar seu Login."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->put('/empresa', function ($request, $response, $args) {
    $modelUsuario = $request->getParsedBody();
    $usuario = alterarDadosEmpresa($this->db, $modelUsuario);
    $result = array();
    
    $resultItem = array(
        "mensagem" => "Seus dados do foram alterado com sucesso."
    );
    
    
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});
