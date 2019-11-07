<?php

use Slim\Http\Request;
use Slim\Http\Response;

require 'dao.php';


$app->post('/empresa', function ($request, $response, $args) {
    $modelEmpresa = $request->getParsedBody();
    $empresa = cadastrarEmpresa($this->db, $modelEmpresa);
    $result = array();
    $resultItem = array(
        "empresa" => $empresa,
        "mensagem" => "Cadastro realizado com sucesso. Obrigada por escolher o MarketPlace. Você já pode realizar seu Login."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->put('/empresa', function ($request, $response, $args) {
    $modelEmpresa = $request->getParsedBody();
    $empresa = alterarDadosEmpresa($this->db, $modelEmpresa);
    $result = array();
    $resultItem = array(
        "empresa" => $empresa,
        "mensagem" => "Os dados de sua Empresa foram alterados com sucesso. Obrigada por escolher o MarketPlace. Você já pode realizar seu Login."
    );
    array_push($result,$resultItem);
    return $this->response->withJson($result);
});

$app->get('/validadadosempresa/{idUsuario}', function ($request, $response, $args) {
    $empresa = validaDadosEmpresa($this->db, $args['idUsuario']);
    $result = array();
    
    if (count($empresa)>0){
        $resultItem = array(
            "empresa" => $empresa,
            "mensagem" => "Empresa Localizada."
        );
       
    }else{
        $resultItem = array(
            "empresa" => $empresa,
            "mensagem" => "Empresa não Localizada."
        );
    }

    array_push($result,$resultItem);
    
    return $this->response->withJson($result);
});

$app->get('/dadosempresa/{idEmpresa}', function ($request, $response, $args) {
    $empresa = dadosEmpresa($this->db, $args['idEmpresa']);
    return $this->response->withJson($empresa);
});


