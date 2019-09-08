<?php

function listarCategoria($db)
{
    
        $str = $db->prepare("SELECT * FROM CATEGORIA");
        // $str->bindParam("BLA", "BLA");
        $str->execute();
        return $str->fetchAll();

    //return array("values" => array("valor1", "valor2"));
}

// function testePost($db, $corpo)
// {
//     return $corpo;
// }
