<?php

function listarProduto($db, $idEmpresa){

    $str = $db->prepare(
        "SELECT m.descricao as marca, c.descricao as categoria,
        p.unidade_medida as uniMedida, p.* from produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        and p.deletado = 'N'
        and p.id_empresa = :idEmpresa
    ");
    $str->bindParam("idEmpresa", $idEmpresa);
    $str->execute();
    return $str->fetchAll();
}

function listarProdutoTodos($db){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as un,
        p.altura, p.largura, p.comprimento, p.peso, p.preco,
        m.descricao as marca, c.descricao as categoria, e.nome_fantasia as empresa, p.imagem,
        0 as quantidade
        FROM produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        inner join empresa e with(nolock) on (e.id = p.id_empresa)
        where deletado = 'N'
        order by p.id desc
    ");
    $str->execute();
    return $str->fetchAll();
}

function listarProdutoCategoria($db, $categoria){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as un,
        p.altura, p.largura, p.comprimento, p.peso, p.preco,
        m.descricao as marca, c.descricao as categoria, e.nome_fantasia as empresa, p.imagem,
        0 as quantidade
        FROM produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        inner join empresa e with(nolock) on (e.id = p.id_empresa)
        where deletado = 'N'
        and c.descricao = :categoria
        order by p.id desc
    ");
    $str->bindParam("categoria", $categoria['categoria']);
    $str->execute();
    return $str->fetchAll();
}

function listarProdutoMarca($db, $marca){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as un,
        p.altura, p.largura, p.comprimento, p.peso, p.preco,
        m.descricao as marca, c.descricao as categoria, e.nome_fantasia as empresa, p.imagem,
        0 as quantidade
        FROM produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        inner join empresa e with(nolock) on (e.id = p.id_empresa)
        where deletado = 'N'
        and m.descricao = :marca
        order by p.id desc
    ");
    $str->bindParam("marca", $marca['marca']);
    $str->execute();
    return $str->fetchAll();
}

function listarProdutoOferta($db){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as un,
        p.altura, p.largura, p.comprimento, p.peso, p.preco,
        m.descricao as marca, c.descricao as categoria, e.nome_fantasia as empresa, p.imagem,
        0 as quantidade
        from itens_oferta_produto iop with(nolock)
        inner join oferta_produto op with(nolock) on (op.id = iop.id_oferta_produto)
        inner join produto p with(nolock) on (p.id = iop.id_produto)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        inner join empresa e with(nolock) on (e.id = p.id_empresa)
        where p.deletado = 'N'
        and op.ativa = 'S'
        order by op.id desc
        
    ");
    $str->execute();
    return $str->fetchAll();
}


function pesquisaProdutoId($db, $id){

    $str = $db->prepare(
        "SELECT p.id, p.codigo, p.descricao, p.aplicacao, p.unidade_medida as uniMedida,
        p.altura, p.largura, p.comprimento, p.peso, p.imagem, p.preco, c.descricao as categoria,
        m.descricao as marca, p.data_cadastro as dataCadastro, p.peso, p.validade
        from produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        where p.id = '" .$id. "'
        and p.deletado = 'N'
    ");
    $str->execute();
    return $str->fetchAll();
}

function buscarProduto($db, $busca){

    $str = $db->prepare(
        "Declare @busca varchar(MAX);
        Set @busca = :busca
        SELECT p.codigo, p.descricao, p.aplicacao, p.unidade_medida as un,
        p.altura, p.largura, p.comprimento, p.peso, p.preco,
        m.descricao as marca, c.descricao as categoria, e.nome_fantasia as empresa, p.imagem
        FROM produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
        inner join empresa e with(nolock) on (e.id = p.id_empresa)
        where p.deletado = 'N'
        and m.descricao like @busca
        or c.descricao like @busca
        or p.descricao like @busca
        or p.codigo like @busca
        or p.aplicacao like @busca
        order by p.id desc
    ");
    $like = "%" . $busca . "%";
    $str->bindParam("busca", $like); 
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
        "INSERT INTO PRODUTO(
            id_categoria
            , id_marca
            , id_empresa
            , codigo
            , descricao
            , aplicacao
            , unidade_medida
            , altura
            , largura
            , comprimento
            , peso
            , data_cadastro
            , deletado
            , preco
            , imagem
            , validade)
        VALUES( 
            :idCategoria
            , :idMarca
            , :idEmpresa
            , :codigo
            , :descricao
            , :aplicacao
            , :uniMedida
            , :altura
            , :largura
            , :comprimento
            , :peso
            , convert(DATE, :dataCadastro, 103)
            , 'N'
            , :preco
            , :imagem
            , convert(DATE, :validade, 103)
        )
     ");
    $str->bindParam("idCategoria", $idCategoria);
    $str->bindParam("idMarca", $idMarca);
    $str->bindParam("idEmpresa", $produto["idEmpresa"]);
    $str->bindParam("codigo", $produto["codigo"]);
    $str->bindParam("descricao", $produto["descricao"]);
    $str->bindParam("aplicacao", $produto["aplicacao"]);
    $str->bindParam("uniMedida", $produto["uniMedida"]);
    $str->bindParam("altura", $produto["altura"]);
    $str->bindParam("largura", $produto["largura"]);
    $str->bindParam("comprimento", $produto["comprimento"]);
    $str->bindParam("peso", $produto["peso"]);
    $str->bindParam("dataCadastro", $produto['dataCadastro']);
    $str->bindParam("preco", floatval($produto['preco']));
    $str->bindParam("imagem", $produto["imagem"]);
    $str->bindParam("validade", $produto["validade"]);
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
        "
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
            , imagem = :imagem
            , validade = convert(DATE, :validade, 103)
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
    $str->bindParam("validade", $produto["validade"]);
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
