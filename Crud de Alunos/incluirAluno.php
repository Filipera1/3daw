<?php
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  
    {
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $matricula = $_POST["matricula"];
        $data = $_POST["data"];

        $msg = "";
        
        if (!file_exists("alunos.txt"))
        {
            $arqDisc = fopen("alunos.txt","w") or die("erro ao criar arquivo");
            $linha = "nome;cpf;matricula;data;\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("alunos.txt","a") or die("erro ao criar arquivo");
        $linha = $nome . ";" . $cpf . ";" . $matricula . ";" . $data ."\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incluir aluno</title>
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

        <h1>Incluir novo aluno</h1>
        <form action="incluirAluno.php" method="POST">
                Nome: <input type="text" name="nome">
                <br><br>
                CPF: <input type="text" name="cpf">
                <br><br>
                Matricula: <input type="text" name="matricula">
                <br><br>
                Data de Nascimento(DD/MM/AAAA): <input type="text" name="data">
                <br><br>
                <input type="submit" value="Incluir novo aluno">
        </form>

        <p><?php echo $msg ?></p>

        <br>
    </body>
</html>
