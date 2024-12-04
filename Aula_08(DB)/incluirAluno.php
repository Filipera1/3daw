<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $matricula = $_POST['matricula'];
    $data_nascimento = $_POST['data_nascimento'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=escola", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO alunos (nome, cpf, matricula, data_nascimento) VALUES (:nome, :cpf, :matricula, :data_nascimento)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':cpf' => $cpf,
            ':matricula' => $matricula,
            ':data_nascimento' => $data_nascimento
        ]);

        $mensagem = "Aluno incluído com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Incluir Aluno</title>
</head>
<body>
    <h1>Incluir Aluno</h1>
    <form method="POST">
        Nome: <input type="text" name="nome" required><br>
        CPF: <input type="text" name="cpf" required><br>
        Matrícula: <input type="text" name="matricula" required><br>
        Data de Nascimento: <input type="date" name="data_nascimento" required><br>
        <button type="submit">Incluir Aluno</button>
    </form>
</body>
</html>
