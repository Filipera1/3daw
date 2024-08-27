<?php

    $v1 = $_GET["a"];
    $v2 = $_GET["b"];
    $operacao = $_GET["operacao"];
    $result1 = 0;
    $result2 = 0;

    if ($operacao == "+")
    {
        $result1 = $v1 + $v2; 
    }

    elseif($operacao == "-")
    {
        $result1 = $v1 - $v2;
    }

    elseif($operacao == "*")
    {
        $result1 = $v1 * $v2;
    }
    
    elseif($operacao == "/")
    {
        $result1 = $v1 / $v2;
    }

    elseif($operacao == "sqrt")
    {
        $result1 = sqrt($v1);
        $result2 = sqrt($v2);
    }   

    elseif($operacao == "+-")
    {
        $result1 = (-1)*($v1);
        $result2 = (-1)*($v2);
    }

    elseif($operacao == "1/x")
    {
        $result1 = 1/($v1);
        $result2 = 1/($v2);
    }

    elseif($operacao == "cos")
    {
        $result1 = cos(deg2rad($v1));
        $result2 = cos(deg2rad($v2));
    }

    elseif($operacao == "sen")
    {
        $result1 = sin(deg2rad($v1));
        $result2 = sin(deg2rad($v2));
    }

    elseif($operacao == "tan")
    {
        $result1 = tan(deg2rad($v1));
        $result2 = tan(deg2rad($v2));
    }

?>

<DOCTYPE! html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aula 3</title>    
</head>
<body>
    <?php
        
        if(($operacao == "-") || ($operacao == "*") || ($operacao == "/") || ($operacao == "+"))
        echo "<h1>Resultado: $result1<h1>"; 

        else
        echo "<h1>Resultado do item a: $result1<h1> <br> <h1>Resultado do item b: $result2<h1>"; 
        
    ?>
</body>