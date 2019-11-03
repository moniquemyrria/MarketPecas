<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->post('/cotacao', function ($request, $response, $args) {
    $produto = $request->getParsedBody();
    $cotacao = listarCotacaoMenorPreco($this->db, $produto);
    return $this->response->withJson($cotacao);
});

$app->post('/cotacaoregistrar', function ($request, $response, $args) {
    $modelCotacao = $request->getParsedBody();
    $cotacao = cadastrarCotacao($this->db, $modelCotacao);
    $result = array();
    $resultItem = array(
        "cotacao" => $cotacao,
        "mensagem" => "Cotacao registrada com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});