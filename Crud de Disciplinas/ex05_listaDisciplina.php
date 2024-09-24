<?php
    $msg = "";
    $disciplinas = [];

    // Verifica se o arquivo existe e carrega as disciplinas
    if (file_exists("disciplinas.txt")) {
        $arqDisc = fopen("disciplinas.txt", "r") or die("Erro ao abrir o arquivo.");
        while (($linha = fgets($arqDisc)) !== false) {
            $disciplinas[] = explode(";", trim($linha));
        }
        fclose($arqDisc);
    } else {
        $msg = "Arquivo de disciplinas não encontrado.";
    }

    // Verifica a opção selecionada (listar todas ou uma)
    if (isset($_GET['opcao'])) {
        $opcao = $_GET['opcao'];

        if ($opcao == 'uma' && isset($_GET['nome_disciplina'])) {
            $nomeDisciplina = $_GET["nome_disciplina"];
            if (!empty($nomeDisciplina)) {
                $disciplinas = array_filter($disciplinas, function($disciplina) use ($nomeDisciplina) {
                    return $disciplina[0] == $nomeDisciplina;
                });

                if (empty($disciplinas)) {
                    $msg = "Disciplina não encontrada.";
                }
            } else {
                $msg = "Por favor, insira o nome da disciplina.";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de Disciplinas</title>
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

        <h1>Lista de Disciplinas</h1>

        <?php if (!empty($msg)) { echo "<p>$msg</p>"; } ?>

        <table border="1">
            <tr>
                <th>Nome</th>
                <th>Sigla</th>
                <th>Carga Horária</th>
            </tr>
            <?php
                if (!empty($disciplinas)) {
                    foreach ($disciplinas as $disciplina) {
                        echo "<tr>";
                        echo "<td>{$disciplina[0]}</td>";
                        echo "<td>{$disciplina[1]}</td>";
                        echo "<td>{$disciplina[2]}</td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>

        <br>
        <a href="ex05_listaDisciplina.html">Voltar</a>
    </body>
</html>
