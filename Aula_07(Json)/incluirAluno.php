<?php
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'GET')  
    {
        $nome = $_GET["nome"];
        $cpf = $_GET["cpf"];
        $matricula = $_GET["matricula"];
        $data = $_GET["data"];

        $msg = "";
        
        if (!file_exists("alunos.txt"))
        {
            $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
            $linha = "nome;cpf;matricula;data;\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("alunos.txt","a") or die("erro ao criar arquivo");
        $linha = $nome . ";" . $cpf . ";" . $matricula . ";" . $data ."\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";        
    }
?>
