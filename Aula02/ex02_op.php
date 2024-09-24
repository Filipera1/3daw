<?php

    $v1 = $_GET["a"];
    $v2 = $_GET["b"];
    $operacao = $_GET["operacao"];
    $result = 0;

    if ($operacao == "s")
    {
        $result = $v1 + $v2; 
    }

    elseif($operacao == "-")
    {
        $result = $v1 - $v2;
    }

    elseif($operacao == "*")
    {
        $result = $v1 * $v2;
    }
    
    else
    {
        $result = $v1 / $v2;
    }

?>

<DOCTYPE! html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Aula 2</title>    
</head>
<body>
    <?php echo "<h1>Resultado: $result<h1>"; ?>
</body>