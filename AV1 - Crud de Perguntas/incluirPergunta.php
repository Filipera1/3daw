<?php
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  
    {
        $numero = $_POST["numero"];
        $pergunta = $_POST["pergunta"];
        $opcao1 = $_POST["opcao1"];
        $opcao2 = $_POST["opcao2"];
        $opcao3 = $_POST["opcao3"];
        $opcao4 = $_POST["opcao4"];
        $gabarito = $_POST["gabarito"];
        $msg = "";
        
        if (!file_exists("perguntas.txt"))
        {
            $arqDisc = fopen("perguntas.txt","w") or die("erro ao criar arquivo");
            $linha = "numero;pergunta;opcao1;opcao2;opcao3;opcao4;gabarito\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("perguntas.txt","a") or die("erro ao criar arquivo");
        $linha = $numero . ";" . $pergunta . ";" . $opcao1 . ";" . $opcao2 .";" . $opcao3 .";" . $opcao4 .";" . $gabarito ."\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incluir pergunta</title>
    </head>
    <body>
        <header>
            <nav>
                <a href="incluirUsuario.php">Incluir usuario</a> |
                <a href="incluirPergunta.php">Incluir pergunta</a> |
                <a href="alterarPergunta.php">Alterar pergunta</a> |
                <a href="excluirPergunta.php">Excluir pergunta</a> |
                <a href="listaPergunta.html">Listar pergunta</a>
            </nav>
        </header>

        <h1>Criar nova pergunta</h1>
        <form action="incluirPergunta.php" method="POST">
                Numero da pergunta: <input type="text" name="numero">
                <br><br>
                Pergunta: <input type="text" name="pergunta">
                <br><br>
                1: <input type="text" name="opcao1">
                <br><br>
                2: <input type="text" name="opcao2">
                <br><br>
                3: <input type="text" name="opcao3">
                <br><br>
                4: <input type="text" name="opcao4">
                <br><br>
                Gabarito: <input type="text" name="gabarito">
                <br><br>
                <input type="submit" value="Criar nova pergunta">
        </form>
        
        <p><?php echo $msg ?></p>
        <br>
    </body>
</html>
