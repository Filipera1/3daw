<?php
include 'db_connection.php';

$input = file_get_contents("php://input");
$data = json_decode($input, true);

if (isset($data['nome'], $data['cpf'], $data['matricula'], $data['data_nascimento'])) {
    $nome = $data['nome'];
    $cpf = $data['cpf'];
    $matricula = $data['matricula'];
    $dataNascimento = $data['data_nascimento'];

    $sql = "INSERT INTO alunos (nome, cpf, matricula, data_nascimento) 
            VALUES ('$nome', '$cpf', '$matricula', '$dataNascimento')";

    if ($conn->query($sql) === TRUE) {
        echo "Aluno incluído com sucesso!";
    } else {
        echo "Erro ao incluir aluno: " . $conn->error;
    }
} else {
    echo "Dados incompletos!";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incluir Aluno</title>
        <script>
            function EnviarAluno() {
                let nome = document.getElementById("nome").value;
                let cpf = document.getElementById("cpf").value;
                let matricula = document.getElementById("matricula").value;
                let dataNascimento = document.getElementById("data_nascimento").value;

                let aluno = {
                    nome: nome,
                    cpf: cpf,
                    matricula: matricula,
                    data_nascimento: dataNascimento
                };

                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("msg").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("POST", "incluirAluno.php", true);
                xmlhttp.setRequestHeader("Content-Type", "application/json");
                xmlhttp.send(JSON.stringify(aluno));
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
        <h1>Incluir Aluno</h1>
        <form onsubmit="event.preventDefault(); EnviarAluno();">
            Nome: <input type="text" id="nome" required><br><br>
            CPF: <input type="text" id="cpf" required><br><br>
            Matrícula: <input type="text" id="matricula" required><br><br>
            Data de Nascimento: <input type="date" id="data_nascimento" required><br><br>
            <button type="submit">Salvar</button>
        </form>
        <div id="msg"></div>
    </body>
</html>
