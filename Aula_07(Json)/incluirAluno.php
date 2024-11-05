<?php
    if ($_SERVER['REQUEST_METHOD'] == 'GET')  
    {
        $nome = $_GET["nome"];
        $matricula = $_GET["matricula"];
        $email = $_GET["email"];
        
        if (!file_exists("alunos.txt"))
        {
            $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
            $linha = "nome;matricula;email;\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("alunos.txt","a") or die("erro ao criar arquivo");
        
        $linha = $nome . ";" . $matricula . ";" . $email ."\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);    
    }
?>
