<?php
include 'db_connection.php';

$sql = "SELECT * FROM alunos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Matrícula</th>
                <th>Data de Nascimento</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['nome'] . "</td>
                <td>" . $row['cpf'] . "</td>
                <td>" . $row['matricula'] . "</td>
                <td>" . $row['data_nascimento'] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum aluno encontrado.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listar Alunos</title>
        <script>
            function ListarAlunos() {
                let xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("lista").innerHTML = this.responseText;
                    }
                };

                xmlhttp.open("GET", "listarAlunos.php", true);
                xmlhttp.send();
            }
        </script>
    </head>
    <body onload="ListarAlunos();">
        <header>
            <nav>
                <a href="incluirAluno.php">Incluir aluno</a>
                <a href="alterarAluno.php">Alterar aluno</a>
                <a href="excluirAluno.php">Excluir aluno</a>
                <a href="listarAlunos.php">Listar alunos</a>
            </nav>
        </header>
        <h1>Lista de Alunos</h1>
        <div id="lista"></div>
    </body>
</html>
