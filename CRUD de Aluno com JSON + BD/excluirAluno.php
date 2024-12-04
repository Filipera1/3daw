<?php
include 'db_connection.php';

if (isset($_POST['matricula'])) {
    $matricula = $_POST['matricula'];

    $sql = "DELETE FROM alunos WHERE matricula='$matricula'";

    if ($conn->query($sql) === TRUE) {
        echo "Aluno excluído com sucesso!";
    } else {
        echo "Erro ao excluir aluno: " . $conn->error;
    }
} else {
    echo "Matrícula não informada!";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Excluir Aluno</title>
        <script>
            function ExcluirAluno() {
                let matricula = document.getElementById("matricula").value;

                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("msg").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("POST", "excluirAluno.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send("matricula=" + matricula);
            }
        </script>
    </head>
    <body>
        <header>
            <nav>
                <a href="incluirAluno.php">Incluir aluno</a>
                <a href="alterarAluno.php">Alterar aluno</a>
                <a href="excluirAluno.php">Excluir aluno</a>
                <a href="listarAlunos.php">Listar alunos</a>
            </nav>
        </header>
        <h1>Excluir Aluno</h1>
        <form onsubmit="event.preventDefault(); ExcluirAluno();">
            Matrícula: <input type="text" id="matricula" required><br><br>
            <button type="submit">Excluir</button>
        </form>
        <div id="msg"></div>
    </body>
</html>
