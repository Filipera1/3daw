<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $cpf = trim($_POST["cpf"] ?? "");
    $endereco = trim($_POST["endereco"] ?? "");
    $cep = trim($_POST["cep"] ?? "");
    $cidade = trim($_POST["cidade"] ?? "");
    $uf = trim($_POST["uf"] ?? "");

    $formInvalido = false;

    // Funções de validação
    function validaDadosString($strDado) {
        return !empty($strDado);
    }

    function validaEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    function validaCPF($cpf) {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    function validaCEP($cep) {
        return preg_match('/^\d{5}-\d{3}$/', $cep);
    }

    // Validações
    if (!validaDadosString($nome)) {
        $formInvalido = true;
    }

    if (!validaEmail($email)) {
        $formInvalido = true;
    }

    if (!validaCPF($cpf)) {
        $formInvalido = true;
    }

    if (!validaDadosString($endereco)) {
        $formInvalido = true;
    }

    if (!validaCEP($cep)) {
        $formInvalido = true;
    }

    if (!validaDadosString($cidade)) {
        $formInvalido = true;
    }

    if (!in_array($uf, ["RJ", "ES", "SP", "BA", "MG", "PE", "RS"])) {
        $formInvalido = true;
    }

    // Caso o formulário seja válido, inserir no banco
    if (!$formInvalido) {
        $servidor = "localhost";
        $user = "root";
        $senha = "";
        $database = "clientes";

        $conexao = new mysqli($servidor, $user, $senha, $database);

        if ($conexao->connect_error) {
            die("Conexão Falhou: " . $conexao->connect_error);
        } else {
            $comando = "INSERT INTO `cliente` (`nome`, `email`, `cpf`, `endereco`, `cep`, `cidade`, `uf`) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexao->prepare($comando);
            if ($stmt) {
                $stmt->bind_param("sssssss", $nome, $email, $cpf, $endereco, $cep, $cidade, $uf);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo "Cliente cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar cliente.";
                }

                $stmt->close();
            } else {
                echo "Erro na preparação do comando SQL.";
            }
        }

        $conexao->close();
    } else {
        echo "Erro: Formulário inválido!";
    }
}
?>
