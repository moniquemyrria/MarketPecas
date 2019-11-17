<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';

$app->post('/contato', function ($request, $response, $args) {
    $modelContato = $request->getParsedBody();
    $contato = cadastrarContato($this->db, $modelContato);
    return $this->response->withJson($contato);
});

$app->get('/listarcontatossmsoferta', function ($request, $response, $args) {
    $contatoSms = listarContatosSMSOferta($this->db);
    return $this->response->withJson($contatoSms);
});

$app->get('/listarcontatosemailoferta', function ($request, $response, $args) {
    $contatosEmail = listarContatosEmailOferta($this->db);
    return $this->response->withJson($contatosEmail);
});
