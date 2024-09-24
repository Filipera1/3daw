<?php
    $msg = "";
    $perguntas = [];

    if (file_exists("perguntas.txt")) 
    {
        $arqDisc = fopen("perguntas.txt", "r") or die("erro ao abrir o arquivo");
        while (($linha = fgets($arqDisc)) !== false) 
        {
            $perguntas[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $numParaExcluir = $_POST["numero"];

        $arqTemp = fopen("perguntas_temp.txt", "w") or die("erro ao criar arquivo temporário");
        foreach ($perguntas as $pergunta) 
        {
            if ($pergunta[0] != $numParaExcluir) 
            {
                $linha = implode(";", $pergunta) . "\n";
                fwrite($arqTemp, $linha);
            }
        }
        fclose($arqTemp);

        rename("perguntas_temp.txt", "perguntas.txt");

        $msg = "Pergunta excluída com sucesso!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Excluir pergunta</title>
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

        <h1>Excluir pergunta</h1>
        
        <form method="POST">
            <label for="nome">Numero da pergunta a ser excluida:</label>
            <input type="text" name="numero" required><br><br>

            <input type="submit" value="Excluir Pergunta">
        </form>

        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>
        
    </body>
</html>
