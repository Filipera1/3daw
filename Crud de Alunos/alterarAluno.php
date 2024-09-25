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
        $nomeOriginal = $_POST["nome_original"];
        $novoNome = $_POST["nome"];
        $novoCpf = $_POST["cpf"];
        $novaMatricula = $_POST["matricula"];
        $novaData = $_POST["data"];

        for ($i = 0; $i < count($alunos); $i++) 
        {
            if ($alunos[$i][0] == $nomeOriginal) 
            {
                $alunos[$i] = [$novoNome, $novoCpf, $novaMatricula, $novaData];
                break;
            }
        }

        $arqDisc = fopen("alunos.txt", "w") or die("Erro ao abrir o arquivo.");
        foreach ($alunos as $aluno) 
        {
            $linha = implode(";", $aluno) . "\n";
            fwrite($arqDisc, $linha);
        }
        fclose($arqDisc);

        $msg = "Cadastro de aluno atualizado com sucesso!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar aluno</title>
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
        
        <h1>Alterar aluno</h1>
        
        <form method="POST">
            <label for="nome_original">Nome do aluno a alterar:</label>
            <input type="text" name="nome_original" required><br><br>

            <label for="nome">Novo Nome:</label>
            <input type="text" name="nome" required><br>

            <label for="cpf">Nova CPF:</label>
            <input type="text" name="cpf" required><br>

            <label for="matricula">Nova matricula:</label>
            <input type="text" name="matricula" required><br>

            <label for="data">Nova data(DD/MM/AAAA):</label>
            <input type="text" name="data" required><br><br>

            <input type="submit" value="Alterar aluno">
        </form>
        
        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>

    </body>
</html>
