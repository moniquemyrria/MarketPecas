<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';

$app->post('/contato', function ($request, $response, $args) {
    $modelContato = $request->getParsedBody();
    $contato = cadastrarContato($this->db, $modelContato);
    return $this->response->withJson($contato);
});