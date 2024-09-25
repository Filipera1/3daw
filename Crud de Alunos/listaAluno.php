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
    else 
    {
        $msg = "Arquivo de alunos não encontrado.";
    }

    if (isset($_GET['opcao'])) 
    {
        $opcao = $_GET['opcao'];

        if ($opcao == 'um' && isset($_GET['nome_aluno']))
         {
            $nomeAluno = $_GET["nome_aluno"];
            if (!empty($nomeAluno)) 
            {
                $alunos = array_filter($alunos, function($aluno) use ($nomeAluno)
                {
                    return $aluno[0] == $nomeAluno;
                });

                if (empty($alunos)) 
                {
                    $msg = "Aluno não encontrado.";
                }
            } 
            else 
            {
                $msg = "Por favor, insira o nome do aluno.";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de alunos</title>
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

        <h1>Lista de Alunos</h1>

        <table border="1">
            <?php
                if (!empty($alunos)) {
                    foreach ($alunos as $aluno) {
                        echo "<tr>";
                        echo "<td>{$aluno[0]}</td>";
                        echo "<td>{$aluno[1]}</td>";
                        echo "<td>{$aluno[2]}</td>";
                        echo "<td>{$aluno[3]}</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>

        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>

        <br>
        <a href="listaAluno.html">Voltar</a>
    </body>
</html>
