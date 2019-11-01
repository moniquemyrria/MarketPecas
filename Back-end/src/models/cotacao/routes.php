<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes



$app->post('/cotacao', function ($request, $response, $args) {
    $produto = $request->getParsedBody();
    //print_r($produto);
    //return;
    $cotacao = listarCotacaoMenorPreco($this->db, $produto);
    return $this->response->withJson($cotacao);
});