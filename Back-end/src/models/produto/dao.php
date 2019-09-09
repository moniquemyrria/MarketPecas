<?php

function listarProduto($db){

    $str = $db->prepare(
        "SELECT m.descricao as marca, c.descricao as categoria,
        p.unidade_medida as uniMedida, p.* from produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        and p.deletado = 'N'
    ");
    $str->execute();
    return $str->fetchAll();
}

function pesquisaProdutoId($db, $id){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as uniMedida,
        p.altura, p.largura, p.comprimento, p.peso, p.imagem, p.preco, c.descricao as categoria,
        m.descricao as marca, p.data_cadastro as dataCadastro, p.peso
        from produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        where p.id = '" .$id. "'
        and p.deletado = 'N'
    ");
    $str->execute();
    return $str->fetchAll();
}

function cadastrarProduto($db, $produto){  
    //return $produto["imagemBase64"];

    $strMarca = $db->prepare("SELECT id from marca where descricao = '" .$produto["marca"]. "'");
    $strMarca->execute();
    $marca = $strMarca->fetchAll();
    $idMarca = $marca[0]['id'];


    $strCategoria = $db->prepare("SELECT id from Categoria where descricao = '" .$produto["categoria"]. "'");
    $strCategoria->execute();
    $categoria = $strCategoria->fetchAll();
    $idCategoria = $categoria[0]['id'];

   
    $str = $db->prepare(
        "DECLARE 
            @source VARBINARY(MAX),
            @encoded VARCHAR(MAX);
        SET @source = CONVERT(VARBINARY(MAX), :imagem);
        SET @encoded = CAST('' AS XML).value('xs:base64Binary(sql:variable(\"@source\"))', 'varchar(max)')
        INSERT INTO PRODUTO(
            id_categoria
            , id_marca
            , codigo
            , descricao
            , aplicacao
            , unidade_medida
            , altura
            , largura
            , comprimento
            , peso
            , imagem
            , data_cadastro
            , deletado
            , preco)
        VALUES( 
            :idCategoria
            , :idMarca
            , :codigo
            , :descricao
            , :aplicacao
            , :uniMedida
            , :altura
            , :largura
            , :comprimento
            , :peso
            , CONVERT(varbinary(max), @encoded)
            , convert(DATE, :dataCadastro, 103)
            , 'N'
            , :preco
        )
     ");
    $str->bindParam("idCategoria", $idCategoria);
    $str->bindParam("idMarca", $idMarca);
    $str->bindParam("codigo", $produto["codigo"]);
    $str->bindParam("descricao", $produto["descricao"]);
    $str->bindParam("aplicacao", $produto["aplicacao"]);
    $str->bindParam("uniMedida", $produto["uniMedida"]);
    $str->bindParam("altura", $produto["altura"]);
    $str->bindParam("largura", $produto["largura"]);
    $str->bindParam("comprimento", $produto["comprimento"]);
    $str->bindParam("peso", $produto["peso"]);
    $str->bindParam("imagem", $produto["imagem"]);
    $str->bindParam("dataCadastro", $produto['dataCadastro']);
    $str->bindParam("preco", floatval($produto['preco']));
    $str->execute();
    $produto["id"] = $db->lastInsertid();

    return $produto;
}

function alterarProduto($db, $produto){   
    $strMarca = $db->prepare("SELECT id from marca where descricao = '" .$produto["marca"]. "'");
    $strMarca->execute();
    $marca = $strMarca->fetchAll();
    $idMarca = $marca[0]['id'];

    $strCategoria = $db->prepare("SELECT id from Categoria where descricao = '" .$produto["categoria"]. "'");
    $strCategoria->execute();
    $categoria = $strCategoria->fetchAll();
    $idCategoria = $categoria[0]['id'];

    $str = $db->prepare(
        "DECLARE 
            @source VARBINARY(MAX),
            @encoded VARCHAR(MAX);
        SET @source = CONVERT(VARBINARY(MAX), :imagem);
        SET @encoded = CAST('' AS XML).value('xs:base64Binary(sql:variable(\"@source\"))', 'varchar(max)');
        UPDATE PRODUTO SET
            id_categoria = :idCategoria
            , id_marca = :idMarca
            , codigo = :codigo
            , descricao = :descricao
            , aplicacao = :aplicacao
            , unidade_medida = :uniMedida
            , altura = :altura
            , largura = :largura
            , comprimento = :comprimento
            , peso = :peso
           
            , data_cadastro = convert(DATE, :dataCadastro, 103)
            , preco = :preco
        WHERE id = :id
     ");
    $str->bindParam("idCategoria", $idCategoria);
    $str->bindParam("idMarca", $idMarca);
    $str->bindParam("codigo", $produto["codigo"]);
    $str->bindParam("descricao", $produto["descricao"]);
    $str->bindParam("aplicacao", $produto["aplicacao"]);
    $str->bindParam("uniMedida", $produto["uniMedida"]);
    $str->bindParam("altura", $produto["altura"]);
    $str->bindParam("largura", $produto["largura"]);
    $str->bindParam("comprimento", $produto["comprimento"]);
    $str->bindParam("peso", $produto["peso"]);
    $str->bindParam("imagem", $produto["imagem"]);
    $str->bindParam("dataCadastro", $produto['dataCadastro']);
    $str->bindParam("preco", floatval($produto['preco']));
    $str->bindParam("id",  $produto["id"]);
    $str->execute();

    return $produto;
}


function excluirProduto($db, $id){   
    
    $str = $db->prepare(
        "UPDATE PRODUTO SET
            deletado = 'S'
        WHERE id = :id
     ");

    $str->bindParam("id", $id);
    $str->execute();

    return $id;
}
