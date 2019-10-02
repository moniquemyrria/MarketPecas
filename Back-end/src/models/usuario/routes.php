<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';

$app->post('/usuario', function ($request, $response, $args) {
    $modelUsuario = $request->getParsedBody();
    $usuario = cadastrarUsuario($this->db, $modelUsuario[0]);
    return $this->response->withJson($usuario);
});

$app->get('/pesquisaUsuarioId/{id}', function ($request, $response, $args) {
    $usuario = pesquisaUsuarioId($this->db, $args['id']);
    return $this->response->withJson($usuario);
});