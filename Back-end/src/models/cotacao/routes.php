<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/listagemCotacaocliente/{idCliente}', function ($request, $response, $args) {
    $listagem = listarCotacaoPorCliente($this->db, $args['idCliente']);
    return $this->response->withJson($listagem);
});

$app->get('/imprimircotacao/{idCotacao}', function ($request, $response, $args) {
    $listagem = impressaoCotacao($this->db, $args['idCotacao']);
    return $this->response->withJson($listagem);
});

$app->post('/cotacao', function ($request, $response, $args) {
    $produto = $request->getParsedBody();
    $cotacao = listarCotacaoMenorPreco($this->db, $produto);
    return $this->response->withJson($cotacao);
});

$app->post('/cotacaoregistrar', function ($request, $response, $args) {
    $modelDadosCotacao = $request->getParsedBody();
    $dadosCliente = $modelDadosCotacao['cliente'];
    $dadosCotacao = $modelDadosCotacao['cotacao'];

    
    $cotacao = cadastrarCotacao($this->db,  $dadosCliente, $dadosCotacao);
    $result = array();
    $resultItem = array(
        "cotacao" => $cotacao,
        "mensagem" => "Cotacao registrada com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});