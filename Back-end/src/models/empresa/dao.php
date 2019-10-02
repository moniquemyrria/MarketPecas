<?php

function cadastrarEmpresa($db, $empresa){

    $str = $db->prepare(
        "INSERT INTO EMPRESA(
            id_usuario
            , id_endereco
            , id_contato
            , cnpj
            , razao_social
            , nome_fantasia
            , observacao
            , forma_pgto_dinheiro
            , forma_pgto_cartao_credito
            , forma_pgto_cartao_debito
            , forma_pgto_boleto
            , forma_pgto_crediario_proprio
            , loja_linha_leve
            , loja_linha_pesada
            , cobre_oferta_praca
        )
        VALUES(
            :idUsuario
            , :idEndereco
            , :idContato
            , :cnpj
            , :razaoSocial
            , :nomeFantasia
            , :observacao
            , :dinheiro
            , :cartaoCredito
            , :cartaoDebito
            , :boleto
            , :crediarioProprio
            , :linhaLeve
            , :linhaPesada
            , :ofertaPraca
        )
    ");
    $str->bindParam("idUsuario",        $empresa["idUsuario"]);
    $str->bindParam("idEndereco",       $empresa["idEndereco"]);
    $str->bindParam("idContato",        $empresa["idContato"]);
    $str->bindParam("cnpj",             $empresa["cnpj"]);
    $str->bindParam("razaoSocial",      $empresa["razaoSocial"]);
    $str->bindParam("nomeFantasia",     $empresa["nomeFantasia"]);
    $str->bindParam("observacao",       $empresa["obs"]);
    $str->bindValue("dinheiro",         verificaCheck($empresa['checkboxDinheiro']));
    $str->bindValue("cartaoCredito",    verificaCheck($empresa["checkboxCredito"]));
    $str->bindValue("cartaoDebito",     verificaCheck($empresa["checkboxDebito"]));
    $str->bindValue("boleto",           verificaCheck($empresa["checkboxBoleto"]));
    $str->bindValue("crediarioProprio", verificaCheck($empresa["checkboxProprio"]));
    $str->bindValue("linhaLeve",        verificaCheck($empresa["checkboxLeve"]));
    $str->bindValue("linhaPesada",      verificaCheck($empresa["checkboxPesada"]));
    $str->bindValue("ofertaPraca",      verificaCheck($empresa["checkboxOfertaPraca"]));
    $str->execute();
    
    return $empresa;
}

function verificaCheck($value){
    if ($value == true){
        return 'S';
    }
    if ($value == false){
        return 'N';
    }
}



