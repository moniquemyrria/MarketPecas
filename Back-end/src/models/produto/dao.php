<?php

function produtoGet($db)
{

    $str = $db->prepare("
        SELECT m.descricao as marca, c.descricao as categoria,
        p.unidade_medida as uniMedida, p.* from produto p with(nolock)
        inner join marca m with(nolock) on (m.id = p.id_marca)
        inner join categoria c with(nolock) on (c.id = p.id_categoria)
    ");
    $str->execute();
    return $str->fetchAll();
}

function produtoPost($db, $produto)
{
   
    $str = $db->prepare(
        "INSERT INTO PRODUTO(
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
            , deletado)
        VALUES( 
            1 --:idCategoria
            , 1 --:idMarca
            , :codigo
            , :descricao
            , :aplicacao
            , :uniMedida
            , :altura
            , :largura
            , :comprimento
            , :peso
            , ''
            , convert(DATE, :dataCadastro, 103)
            , 'N'
        )
     ");
    // $str->bindParam("idCategoria", $produto["idCategoria"]);
    // $str->bindParam("idMarca", $produto["idMarca"]);
    $str->bindParam("codigo", $produto["codigo"]);
    $str->bindParam("descricao", $produto["descricao"]);
    $str->bindParam("aplicacao", $produto["aplicacao"]);
    $str->bindParam("uniMedida", $produto["uniMedida"]);
    $str->bindParam("altura", $produto["altura"]);
    $str->bindParam("largura", $produto["largura"]);
    $str->bindParam("comprimento", $produto["comprimento"]);
    $str->bindParam("peso", $produto["peso"]);
    // $str->bindParam("imagem", $produto["imagem"]);
    $str->bindParam("dataCadastro", $produto['dataCadastro']);
    $str->execute();
    $produto["id"] = $db->lastInsertId();

    return $produto;
}
