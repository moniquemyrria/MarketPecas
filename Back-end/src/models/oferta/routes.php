<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes


$app->get('/oferta/{idEmpresa}', function ($request, $response, $args) {
    $ofertaOroduto = listarOferta($this->db, $args['idEmpresa']);
    return $this->response->withJson($ofertaOroduto);
});

$app->get('/ofertapesquisaid/{id}', function ($request, $response, $args) {
    $ofertaProduto = pesquisaOfertaId($this->db, $args['id']);
    return $this->response->withJson($ofertaProduto);
});

$app->post('/oferta', function ($request, $response, $args) {
    $modelOfertaProduto = $request->getParsedBody();
    $ofertaProduto = cadastrarOferta($this->db, $modelOfertaProduto);
    $result = array();
    $resultItem = array(
        "oferta" => $ofertaProduto,
        "mensagem" => "Oferta cadastrada com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->put('/oferta', function ($request, $response, $args) {
    $modelOfertaProduto = $request->getParsedBody();
    $oferta = alterarOferta($this->db, $modelOfertaProduto);
    $result = array();
    $resultItem = array(
        "oferta" => $oferta,
        "mensagem" => "Oferta alterada com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->delete('/oferta/{id}', function ($request, $response, $args) {
    $oferta = excluirOferta($this->db, $args['id']);
    $result = array();
    $resultItem = array(
        "oferta" => $oferta,
        "mensagem" => "Oferta excluída com sucesso."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});