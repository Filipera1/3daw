<?php
    $msg = "";
    $alunos = [];

    if (file_exists("alunos.txt")) 
    {
        $arqDisc = fopen("alunos.txt", "r") or die("Erro ao abrir o arquivo.");
        while (($linha = fgets($arqDisc)) !== false) 
        {
            $alunos[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $nomeParaExcluir = $_POST["nome"];

        $arqTemp = fopen("alunos_temp.txt", "w") or die("Erro ao criar arquivo temporário.");
        foreach ($alunos as $aluno)
         {
            if ($aluno[0] != $nomeParaExcluir) 
            {
                $linha = implode(";", $aluno) . "\n";
                fwrite($arqTemp, $linha);
            }
        }
        fclose($arqTemp);

        rename("alunos_temp.txt", "alunos.txt");

        $msg = "Aluno excluído com sucesso!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Excluir aluno</title>
    </head>
    <body>
    <header>
            <nav>
                <a href="incluirAluno.php">Incluir aluno</a> |
                <a href="alterarAluno.php">Alterar aluno</a> |
                <a href="excluirAluno.php">Excluir aluno</a> |
                <a href="listaAluno.html">Listar aluno</a>
            </nav>
        </header>

        <h1>Excluir aluno</h1>
        
        <form method="POST">
            <label for="nome">Nome do aluno a ser excluido:</label>
            <input type="text" name="nome" required><br><br>

            <input type="submit" value="Excluir aluno">
        </form>
        
        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>
        
    </body>
</html>
