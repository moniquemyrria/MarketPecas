<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/teste', function ($request, $response, $args) {
    $teste = testeGet($this->db);
    return $this->response->withJson($teste);
});


$app->post('/teste', function ($request, $response, $args) {
    $corpo = $request->getParsedBody();
    $teste = testePost($this->db, $corpo);
    return $this->response->withJson($teste);
});
