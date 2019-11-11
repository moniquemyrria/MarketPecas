<?php

function listarCotacaoPorCliente($db, $idCliente){

    $str = $db->prepare(
        "DECLARE @idCliente int;
        set @idCliente = :idCliente;
        select c.id, 
            concat(
                (select count(ec.id) from empresa_cotacao ec where ec.id_cotacao = c.id),
                ' Empresas nesta cotação / ', 
                (select count(*) from itens_cotacao ic2 inner join empresa_cotacao ec2 on (ec2.id = ic2.id_empresa_cotacao) inner join cotacao c2 on (c2.id = ec2.id_cotacao) where c2.id = c.id),
                ' produtos cotados'
            ) as dadosCotacao,
            convert(nvarchar, c.data, 103) as data
        from cotacao c with(nolock)
        where c.id_cliente = @idCliente
        order by c.data desc
    ");
    $str->bindParam("idCliente", $idCliente);
    $str->execute();
    return $str->fetchAll();
}

function impressaoCotacao($db, $idCotacao){

    $str = $db->prepare(
        "SELECT ec.id as idEmpresaCotacao, ec.id_cotacao as idCotacao,   
        ec.id_empresa as idEmpresa, e.nome_fantasia as nomeFantasia, ec.valor_total_cotacao as valorCotacao
        from empresa_cotacao ec
        inner join empresa e with(nolock) on (e.id = ec.id_empresa)
        where id_cotacao = :idCotacao
        
    ");
    $str->bindParam("idCotacao", $idCotacao);
    $str->execute();
    $empresaCotacao = $str->fetchAll();

    $arrayG = array();
    foreach($empresaCotacao as $key => $item){

        $itens = array();
        $sttr = $db->prepare(
            "SELECT ic.id_empresa_cotacao as idEmpresaCotacao, ic.id_produto as idProduto, 
            p.descricao, ic.quantidade, ic.valor_total_produto as valorProduto
            from itens_cotacao ic
            inner join produto p with(nolock) on (p.id = ic.id_produto)
            where id_empresa_cotacao = :idEmpresaCotacao
            
        ");
        $sttr->bindParam("idEmpresaCotacao", $item['idEmpresaCotacao']);
        $sttr->execute();
        $itensCotacao = $sttr->fetchAll();

        foreach($itensCotacao as $key => $item2){
            $arrayAux = array(
                "idEmpresaCotacao" => $item2['idEmpresaCotacao'],
                "idProduto" => $item2['idProduto'],
                "descricao" => $item2['descricao'],
                "quantidade" => $item2['quantidade'],
                "valorProduto" => $item2['valorProduto']
            );

            array_push($itens, $arrayAux);
        }

        $arrayAuxG = array(
            "idEmpresaCotacao" => $item['idEmpresaCotacao'],
            "idCotacao" => $item['idCotacao'],
            "idEmpresa" => $item['idEmpresa'],
            "nomeFantasia" => $item['nomeFantasia'],
            "valorCotacao" => $item['valorCotacao'],
            "itens" => $itens,
        );

        array_push($arrayG, $arrayAuxG);
    }

    return $arrayG;
}


function listarCotacaoMenorPreco($db, $produtos){

    //dados dos itens
    $produtoDescricao = $produtos[0]['descricao'];

    $strr = $db->prepare(
        
        "SELECT t.* from (
            SELECT e.id as idEmpresa,
            e.cnpj, e.cobre_oferta_praca as cobreOferta, razao_social as razSocial, nome_fantasia as nomeFant,
            e.observacao, e.forma_pgto_dinheiro as fpDinheiro, e.forma_pgto_cartao_credito as fpCredito,
            e.forma_pgto_cartao_debito as fpDebito, e.forma_pgto_boleto as fpBoleto, e.forma_pgto_crediario_proprio as fpCrediario,
            en.logradouro, en.numero, en.bairro, c.whatsapp, c.facebook
            from produto p with(nolock)
            inner join empresa e with(nolock) on (e.id = p.id_empresa)
            inner join endereco en with(nolock) on (en.id = e.id_endereco)
            inner join contato c with(nolock) on (c.id = e.id_contato)
            inner join marca m with(nolock) on (m.id = p.id_marca)
            inner join categoria ca with(nolock) on (ca.id = p.id_categoria)
            where p.descricao in (" . $produtoDescricao .")
        ) as t
        group by 
            t.idEmpresa, t.cnpj, t.cobreOferta, t.razSocial, t.nomeFant, t.observacao,
            t.fpDinheiro, t.fpCredito,t.fpDebito, t.fpBoleto, 
            t.fpCrediario, t.logradouro, t.numero, t.bairro, t.whatsapp, t.facebook     
		 order by t.idEmpresa, t.razSocial asc
    ");
    $strr->execute();
    $idsEmpresas = $strr->fetchAll();

    
    $str = $db->prepare(
        
        "SELECT t.* from (
            SELECT e.id as idEmpresa, p.id as idProduto, p.preco, p.descricao as descProduto, 
            e.cnpj, e.cobre_oferta_praca as cobreOferta, razao_social as razSocial, nome_fantasia as nomeFant,
            e.observacao, e.forma_pgto_dinheiro as fpDinheiro, e.forma_pgto_cartao_credito as fpCredito,
            e.forma_pgto_cartao_debito as fpDebito, e.forma_pgto_boleto as fpBoleto, e.forma_pgto_crediario_proprio as fpCrediario,
            en.logradouro, en.numero, en.bairro, c.whatsapp, m.descricao as marca, ca.descricao as categoria 
            from produto p with(nolock)
            inner join empresa e with(nolock) on (e.id = p.id_empresa)
            inner join endereco en with(nolock) on (en.id = e.id_endereco)
            inner join contato c with(nolock) on (c.id = e.id_contato)
            inner join marca m with(nolock) on (m.id = p.id_marca)
            inner join categoria ca with(nolock) on (ca.id = p.id_categoria)
            where p.descricao in (" . $produtoDescricao .")
        ) as t
        group by 
            t.idEmpresa, t.idProduto, t.preco, t.descProduto, t.cnpj, t.cobreOferta, t.razSocial, t.nomeFant, t.observacao,
            t.fpDinheiro, t.fpCredito,t.fpDebito, t.fpBoleto, 
            t.fpCrediario, t.logradouro, t.numero, t.bairro, t.whatsapp, t.categoria, t.marca
        order by t.preco, t.razSocial asc
    ");
    $str->execute();
    $cotacao = $str->fetchAll();
    
    $arrayG = array();
    $arrayCotacao = array();
    foreach($idsEmpresas as $key => $item){
        
        $arrayC = array();
        foreach($cotacao as $key => $aux){

            if ($aux['idEmpresa'] == $item["idEmpresa"]){
                $arrayGAux = array(
                    "idProduto"=> $aux['idProduto'],
                    "descProduto"=> $aux['descProduto'],
                    "valor"=> floatval($aux['preco']),
                    "marca"=> $aux['marca'],
                    "quantidade"=> intval(1),
                    "totalProduto"=> floatval(0),
                );

                array_push($arrayC,  $arrayGAux);
            }

        }

        $arrayG = array(
            "seq"=>$key,
            "idEmpresa" => $item["idEmpresa"], 
            "cnpj" => $item["cnpj"],
            "cobreOferta" => $item["cobreOferta"],
            "razSocial" => $item["razSocial"],
            "nomeFant" => $item["nomeFant"],
            "observacao" => $item["observacao"],
            "fpDinheiro" => $item["fpDinheiro"],
            "fpCredito" => $item["fpCredito"],
            "fpDebito" => $item["fpDebito"],
            "fpBoleto" => $item["fpBoleto"],
            "fpCrediario" => $item["fpCrediario"],
            "logradouro" => $item["logradouro"],
            "numero" => $item["numero"],
            "bairro" => $item["bairro"],
            "whatsapp" => $item["whatsapp"],
            "facebook" => $item["facebook"],
            "totalProdutosCotacao" => floatval(0),
            "produtosCotacao" => $arrayC
        );

        array_push($arrayCotacao,  $arrayG);

    }

    return $arrayCotacao;
    
}

function cadastrarCotacao($db, $dadosCliente, $dadosCotacao){  

    //salvando dados cotacao
    $str = $db->prepare(
        "INSERT INTO COTACAO(
            id_cliente
            , data
        )
        VALUES( 
            :idCliente
            , convert(nvarchar, getdate(), 103) 
        )
        ");

    $str->bindParam("idCliente", $dadosCliente["idCliente"]);
    $str->execute();
    $idCotacao = $db->lastInsertid();

    foreach($dadosCotacao as $key => $item){

        $strr = $db->prepare(
            "INSERT INTO EMPRESA_COTACAO(
                id_cotacao
                , id_empresa
                , valor_total_cotacao
            )
            VALUES( 
                :idCotacao
                , :idEmpresa
                , :valorTotalCotacao
            )
        ");
        $strr->bindParam("idCotacao",           $idCotacao);
        $strr->bindParam("idEmpresa",           $item["idEmpresa"]);
        $strr->bindParam("valorTotalCotacao",   $item["totalProdutosCotacao"]);
        $strr->execute();
        $idEmpresaCotacao = $db->lastInsertid();
        
        //itens da cotacao - produtos
        foreach($item['produtosCotacao'] as $key => $itemP){
            $strrr = $db->prepare(
                "INSERT INTO ITENS_COTACAO(
                    id_empresa_cotacao
                    , id_produto
                    , quantidade
                    , valor_total_produto
                )
                VALUES( 
                    :idEmpresaCotacao
                    , :idProduto
                    , :quantidade
                    , :valorTotalProduto
                )
            ");
            $strrr->bindParam("idEmpresaCotacao",   $idEmpresaCotacao);
            $strrr->bindParam("idProduto",          $itemP["idProduto"]);
            $strrr->bindParam("quantidade",         $itemP["quantidade"]);
            $strrr->bindParam("valorTotalProduto",  $itemP["totalProduto"]);
            $strrr->execute();
        }

    }

    return "";//$cotacao;
}

