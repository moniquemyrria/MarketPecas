<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/produto', function ($request, $response, $args) {
    $produto = produtoGet($this->db);
    return $this->response->withJson($produto);
});


$app->post('/produto', function ($request, $response, $args) {
    $modelProduto = $request->getParsedBody();
    $produto = produtoPost($this->db, $modelProduto);
    $result = array();
    $resultItem = array(
        "produto" => $produto,
        "mensagem" => "Produto cadastrado com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});
