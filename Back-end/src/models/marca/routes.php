<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';
// Routes

$app->get('/marca', function ($request, $response, $args) {
    $marca = marcaGet($this->db);
    return $this->response->withJson($marca);
});


// $app->post('/teste', function ($request, $response, $args) {
//     $corpo = $request->getParsedBody();
//     $teste = testePost($this->db, $corpo);
//     return $this->response->withJson($teste);
// });
