<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/produto', function ($request, $response, $args) {
    $produto = listarProduto($this->db);
    return $this->response->withJson($produto);
});

$app->get('/produtopesquisaid/{id}', function ($request, $response, $args) {
    $produto = pesquisaProdutoId($this->db, $args['id']);
    return $this->response->withJson($produto);
});


$app->post('/produto', function ($request, $response, $args) {
    $modelProduto = $request->getParsedBody();
    $produto = cadastrarProduto($this->db, $modelProduto);
    $result = array();
    $resultItem = array(
        "produto" => $produto,
        "mensagem" => "Produto cadastrado com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->put('/produto', function ($request, $response, $args) {
    $modelProduto = $request->getParsedBody();
    $produto = alterarProduto($this->db, $modelProduto);
    $result = array();
    $resultItem = array(
        "produto" => $produto,
        "mensagem" => "Produto alterado com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->delete('/produto/{id}', function ($request, $response, $args) {
    $produto = excluirProduto($this->db, $args['id']);
    $result = array();
    $resultItem = array(
        "produto" => $produto,
        "mensagem" => "Produto excluído com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

