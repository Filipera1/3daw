<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $matricula = $_POST['matricula'];
    $data_nascimento = $_POST['data_nascimento'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=escola", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE alunos SET nome = :nome, cpf = :cpf, matricula = :matricula, data_nascimento = :data_nascimento WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':matricula' => $matricula,
            ':data_nascimento' => $data_nascimento
        ]);

        $mensagem = "Aluno alterado com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Alterar Aluno</title>
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
    <h1>Alterar Aluno</h1>
    <form method="POST">
        ID do Aluno: <input type="number" name="id" required><br>
        Nome: <input type="text" name="nome" required><br>
        CPF: <input type="text" name="cpf" required><br>
        Matrícula: <input type="text" name="matricula" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        <button type="submit">Alterar Aluno</button>
    </form>
</body>
</html>
