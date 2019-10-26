<?php

function listarOferta($db, $idEmpresa){

    $str = $db->prepare(
        "SELECT *from oferta_produto op with(nolock)
        where op.ativa = 'S'
        and op.id_empresa = :idEmpresa
    ");
    $str->bindParam("idEmpresa", $idEmpresa);
    $str->execute();
    return $str->fetchAll();
}

function cadastrarOferta($db, $produtoOferta){ 
    
    $str = $db->prepare(
        "INSERT INTO OFERTA_PRODUTO(
            ativa
            , nome
            , id_empresa
        )
        VALUES( 
            'S'
            , :nome
            , :idEmpresa
        )
     ");
    
    $str->bindParam("nome", $produtoOferta["nome"]);
    $str->bindParam("idEmpresa", $produtoOferta["idEmpresa"]);
    $str->execute();
    $produtoOferta["id"] = $db->lastInsertid();
    //print_r($idOferta);

    foreach($produtoOferta['itensOferta'] as $key => $item){
        $sth = $db->prepare(
            "INSERT INTO itens_oferta_produto(
                id_oferta_produto
                , id_produto
                , preco
            )
            VALUES( 
                :idOferta
                , :idProduto
                , :preco
            )
         ");
        
        $sth->bindParam("idOferta",     $produtoOferta["id"]);
        $sth->bindParam("idProduto",    $item["id"]);
        $sth->bindParam("preco",        $item["preco"]);
        $sth->execute();

    }

    return $produtoOferta;
}

function alterarOferta($db, $produtoOferta){ 
    
    $str = $db->prepare(
        "UPDATE OFERTA_PRODUTO SET nome = :nome 
        WHERE id = :idOfertaProduto
        and id_empresa = :idEmpresa
    ");
    
    $str->bindParam("nome",             $produtoOferta["nome"]);
    $str->bindParam("idOfertaProduto",  $produtoOferta["idOfertaProduto"]);
    $str->bindParam("idEmpresa",        $produtoOferta["idEmpresa"]);
    $str->execute();
    
    //print_r($idOferta);

    foreach($produtoOferta['itensOferta'] as $key => $item){
        $sth = $db->prepare(
            "INSERT INTO itens_oferta_produto(
                id_oferta_produto
                , id_produto
                , preco
            )
            VALUES( 
                :idOferta
                , :idProduto
                , :preco
            )
         ");
        
        $sth->bindParam("idOferta",     $produtoOferta["id"]);
        $sth->bindParam("idProduto",    $item["id"]);
        $sth->bindParam("preco",        $item["preco"]);
        $sth->execute();

    }

    return $produtoOferta;
}

function pesquisaOfertaId($db, $id){

    $str = $db->prepare(
        "SELECT op.id as idOfertaProduto, op.nome, p.id as idProduto, p.codigo, p.descricao, m.descricao as marca, 
        c.descricao as categoria, iop.preco FROM itens_oferta_produto iop with(nolock)
        inner join oferta_produto op with(nolock) on (op.id = iop.id_oferta_produto)
        inner join produto p with(nolock) on (p.id = iop.id_produto)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        where op.ativa = 'S'
        and op.id = '" .$id. "'
    ");
    $str->execute();
    $oferta = $str->fetchAll();
    
    $arrayItens = array();
    $arrayItens = array();
    foreach($oferta as $key => $item){
    
        $arrayAux = array(
            "id" => $item['idProduto'],
            "codigo" => $item['codigo'],
            "descricao" => $item['descricao'],
            "marca" => $item['marca'],
            "categoria" => $item['categoria'],
            "preco" => $item['preco'],
        );

        array_push($arrayItens, $arrayAux);
    }

    $arrayG = array(
        "idOfertaProduto"=> $oferta[0]['idOfertaProduto'],
        "nome"=> $oferta[0]['nome'],
        "itensOferta"=>$arrayItens
    );


    return $arrayG;
}

function excluirOferta($db, $id){   
    
    $str = $db->prepare(
        "UPDATE oferta_produto SET
            ativa = 'N'
        WHERE id = :id
     ");

    $str->bindParam("id", $id);
    $str->execute();

    return $id;
}