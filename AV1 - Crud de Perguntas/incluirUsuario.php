<?php
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST')  
    {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $msg = "";
        
        if (!file_exists("usuarios.txt"))
        {
            $arqDisc = fopen("usuarios.txt","w") or die("erro ao criar arquivo");
            $linha = "nome;email;senha\n";
            fwrite($arqDisc, $linha);
            fclose($arqDisc);
        }

        $arqDisc = fopen("usuarios.txt","a") or die("erro ao criar arquivo");
        $linha = $nome . ";" . $email . ";" . $senha . "\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
        $msg = "Deu tudo certo!!!";        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incluir usuario</title>
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

        <h1>Criar novo usuario</h1>
        <form action="incluirUsuario.php" method="POST">
                Nome: <input type="text" name="nome">
                <br><br>
                Email: <input type="text" name="email">
                <br><br>
                Senha: <input type="text" name="senha">
                <br><br>
                <input type="submit" value="Criar novo usuario">
        </form>

        <p><?php echo $msg ?></p>
        <br>
    </body>
</html>
