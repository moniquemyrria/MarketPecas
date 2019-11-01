<?php

function listarCotacaoMenorPreco($db, $produtos){

    $strr = $db->prepare(
        
        "SELECT t.* from (
            SELECT e.id as idEmpresa
            from produto p with(nolock)
            inner join empresa e with(nolock) on (e.id = p.id_empresa)
            inner join endereco en with(nolock) on (en.id = e.id_endereco)
            inner join contato c with(nolock) on (c.id = e.id_contato)
            inner join marca m with(nolock) on (m.id = p.id_marca)
            inner join categoria ca with(nolock) on (ca.id = p.id_categoria)
            where p.descricao in ('JOGO DE VELA','BATERIA ACEDELCO')
        ) as t
        group by 
            t.idEmpresa
    ");
    $strr->execute();
    $idsEmpresas = $strr->fetchAll();

    //dados dos itens
    $produtoDescricao = $produtos[0]['descricao'];
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
                    "valor"=> $aux['preco']
                );

                array_push($arrayC,  $arrayGAux);
            }

        }

        $arrayG = array(
            "idEmpresa" => $item["idEmpresa"],
            "produtos" => $arrayC
        );


        array_push($arrayCotacao,  $arrayG);

    }

    return $arrayCotacao;
    
}

