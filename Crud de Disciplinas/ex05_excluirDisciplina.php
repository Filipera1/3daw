<?php
    $msg = "";
    $disciplinas = [];

    if (file_exists("disciplinas.txt")) {
        $arqDisc = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo.");
        while (($linha = fgets($arqDisc)) !== false) {
            $disciplinas[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nomeParaExcluir = $_POST["nome"];

        $arqTemp = fopen("disciplinas_temp.txt", "w") or die("Erro ao criar arquivo temporário.");
        foreach ($disciplinas as $disciplina) {
            if ($disciplina[0] != $nomeParaExcluir) {
                $linha = implode(";", $disciplina) . "\n";
                fwrite($arqTemp, $linha);
            }
        }
        fclose($arqTemp);

        rename("disciplinas_temp.txt", "disciplinas.txt");

        $msg = "Disciplina excluída com sucesso!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Excluir Disciplina</title>
    </head>
    <body>
    <header>
            <nav>
                <a href="ex05_incluirDisciplina.php">Incluir</a> |
                <a href="ex05_alterarDisciplina.php">Alterar</a> |
                <a href="ex05_excluirDisciplina.php">Excluir</a> |
                <a href="ex05_listaDisciplina.html">Listar</a>
            </nav>
        </header>

        <h1>Excluir Disciplina</h1>
        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>
        <form method="POST">
            <label for="nome">Nome da Disciplina a Excluir:</label>
            <input type="text" name="nome" required><br><br>

            <input type="submit" value="Excluir Disciplina">
        </form>
    </body>
</html>
