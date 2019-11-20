<?php

function listarCategoria($db)
{
    
        $str = $db->prepare("SELECT * FROM CATEGORIA order by descricao asc");
        // $str->bindParam("BLA", "BLA");
        $str->execute();
        return $str->fetchAll();

    //return array("values" => array("valor1", "valor2"));
}

// function testePost($db, $corpo)
// {
//     return $corpo;
// }
