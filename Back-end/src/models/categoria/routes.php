<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/categoria', function ($request, $response, $args) {
    $categoria = categoriaGet($this->db);
    return $this->response->withJson($categoria);
});


// $app->post('/teste', function ($request, $response, $args) {
//     $corpo = $request->getParsedBody();
//     $teste = testePost($this->db, $corpo);
//     return $this->response->withJson($teste);
// });
