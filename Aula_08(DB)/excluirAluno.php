<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $conn = new PDO("mysql:host=localhost;dbname=escola", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM alunos WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $mensagem = "Aluno excluído com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Excluir Aluno</title>
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
    <h1>Excluir Aluno</h1>
    <form method="POST">
        ID do Aluno: <input type="number" name="id" required><br>
        <button type="submit">Excluir Aluno</button>
    </form>
</body>
</html>
