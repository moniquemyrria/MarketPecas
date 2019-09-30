<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';

$app->post('/endereco', function ($request, $response, $args) {
    $modelEndereco = $request->getParsedBody();
    $endereco = cadastrarEndereco($this->db, $modelEndereco);
    return $this->response->withJson($endereco);
});
