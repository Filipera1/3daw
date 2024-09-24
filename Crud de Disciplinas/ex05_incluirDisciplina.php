<?php
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  
    {
        $nome = $_POST["nome"];
        $sigla = $_POST["sigla"];
        $carga = $_POST["carga"];
        $msg = "";
        
        if (!file_exists("disciplinas.txt"))
        {
            $arqDisc = fopen("disciplinas.txt","w") or die("erro ao criar arquivo");
            $linha = "nome;sigla;carga\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("disciplinas.txt","a") or die("erro ao criar arquivo");
        $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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

        <h1>Criar Nova Disciplina</h1>
        <form action="ex05_incluirDisciplina.php" method="POST">
                Sigla: <input type="text" name="sigla">
                <br><br>
                Nome: <input type="text" name="nome">
                <br><br>
                Carga Horaria: <input type="text" name="carga">
                <br><br>
                <input type="submit" value="Criar Nova Disciplina">
        </form>
        <p><?php echo $msg ?></p>
        <br>
    </body>
</html>
