<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=escola", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM alunos";
    $stmt = $conn->query($sql);
    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Listar Alunos</title>
</head>
<body>
    <h1>Lista de Alunos</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Matrícula</th>
            <th>Data de Nascimento</th>
        </tr>
        <?php foreach ($alunos as $aluno): ?>
            <tr>
                <td><?= $aluno['id'] ?></td>
                <td><?= $aluno['nome'] ?></td>
                <td><?= $aluno['cpf'] ?></td>
                <td><?= $aluno['matricula'] ?></td>
                <td><?= $aluno['data_nascimento'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
