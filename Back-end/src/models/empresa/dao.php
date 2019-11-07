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

function alterarDadosEmpresa($db, $empresa){

    //aletrando dados da empresa
    $emp = $db->prepare(
        "UPDATE EMPRESA SET
             observacao = :observacao
            , forma_pgto_dinheiro = :dinheiro
            , forma_pgto_cartao_credito = :cartaoCredito
            , forma_pgto_cartao_debito = :cartaoDebito
            , forma_pgto_boleto = :boleto
            , forma_pgto_crediario_proprio = :crediarioProprio
            , loja_linha_leve = :linhaLeve
            , loja_linha_pesada = :linhaPesada
            , cobre_oferta_praca = :ofertaPraca
        WHERE id = :idEmpresa
    ");

    $emp->bindParam("idEmpresa",        $empresa["id"]);
    $emp->bindParam("observacao",       $empresa["observacao"]);
    $emp->bindValue("dinheiro",         verificaCheck($empresa['forma_pgto_dinheiro']));
    $emp->bindValue("cartaoCredito",    verificaCheck($empresa["forma_pgto_cartao_credito"]));
    $emp->bindValue("cartaoDebito",     verificaCheck($empresa["forma_pgto_cartao_debito"]));
    $emp->bindValue("boleto",           verificaCheck($empresa["forma_pgto_boleto"]));
    $emp->bindValue("crediarioProprio", verificaCheck($empresa["forma_pgto_crediario_proprio"]));
    $emp->bindValue("linhaLeve",        verificaCheck($empresa["loja_linha_leve"]));
    $emp->bindValue("linhaPesada",      verificaCheck($empresa["loja_linha_pesada"]));
    $emp->bindValue("ofertaPraca",      verificaCheck($empresa["cobre_oferta_praca"]));
    $emp->execute();

    //alterando dado do usuario
    $usu = $db->prepare(
        "UPDATE usuario SET senha = :senha
        where id = :idUsuario
    ");
    $usu->bindParam("idUsuario", $empresa["id_usuario"]);
    $usu->bindParam("senha", $empresa["senha"]);
    $usu->execute();

    //alterando endereco
    $end = $db->prepare(
        "UPDATE ENDERECO SET
            logradouro = :logradouro
            , numero = :numero
            , bairro = :bairro
            , cep = :cep
        where id = :idEndereco
    ");
    $end->bindParam("idEndereco", $empresa["id_endereco"]);
    $end->bindParam("logradouro", $empresa["logradouro"]);
    $end->bindParam("numero", $empresa["numero"]);
    $end->bindParam("bairro", $empresa["bairro"]);
    $end->bindParam("cep", $empresa["cep"]);
    $end->execute();

    $cont = $db->prepare(
        "UPDATE CONTATO SET
            telefone = :telefone
            , whatsapp = :wapp
            , facebook = :fb
        WHERE id = :idContato
    ");
    $cont->bindParam("idContato", $empresa["id_contato"]);
    $cont->bindParam("telefone", $empresa["telefone"]);
    $cont->bindParam("wapp", $empresa["whatsapp"]);
    $cont->bindParam("fb", $empresa["facebook"]);
    $cont->execute();
    
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

function validaDadosEmpresa($db, $idUsuario){

    $str = $db->prepare(
        "SELECT e.id as idEmpresa, u.id as idUsuario, u.email, u.tipo_pessoa, u.ativo from usuario u with(nolock)
        inner join empresa e with(nolock) on (e.id_usuario = u.id)
        where u.id = :id
    ");
    $str->bindParam("id", $idUsuario);
    $str->execute();
    return $str->fetchAll();
}

function dadosEmpresa($db, $idEmpresa){

    $str = $db->prepare(
        "SELECT * from empresa with(nolock)
        where id = :id
    ");
    $str->bindParam("id", $idEmpresa);
    $str->execute();
    return $str->fetchAll();
}





