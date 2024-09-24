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
        $nomeOriginal = $_POST["nome_original"];
        $novoNome = $_POST["nome"];
        $novaSigla = $_POST["sigla"];
        $novaCarga = $_POST["carga"];

        for ($i = 0; $i < count($disciplinas); $i++) {
            if ($disciplinas[$i][0] == $nomeOriginal) {
                $disciplinas[$i] = [$novoNome, $novaSigla, $novaCarga];
                break;
            }
        }

        $arqDisc = fopen("disciplinas.txt", "w") or die("Erro ao abrir o arquivo.");
        foreach ($disciplinas as $disciplina) {
            $linha = implode(";", $disciplina) . "\n";
            fwrite($arqDisc, $linha);
        }
        fclose($arqDisc);

        $msg = "Disciplina atualizada com sucesso!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Alterar Disciplina</title>
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
        
        <h1>Alterar Disciplina</h1>
        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>
        <form method="POST">
            <label for="nome_original">Nome da Disciplina a Alterar:</label>
            <input type="text" name="nome_original" required><br><br>

            <label for="nome">Novo Nome:</label>
            <input type="text" name="nome" required><br>

            <label for="sigla">Nova Sigla:</label>
            <input type="text" name="sigla" required><br>

            <label for="carga">Nova Carga Horária:</label>
            <input type="text" name="carga" required><br><br>

            <input type="submit" value="Atualizar Disciplina">
        </form>
    </body>
</html>
