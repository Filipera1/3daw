function ValidarNome(nome) {
    return nome.trim().length > 0;
}

function ValidarEmail(email) {
    const regex = /\S+@\S+\.\S+/;
    return regex.test(email);
}

function ValidarCpf(cpf) {
    let soma = 0, resto;
    cpf = cpf.replace(/\D/g, "");  
    
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) return false;

    for (let i = 1; i <= 9; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;
    for (let i = 1; i <= 10; i++)
        soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    return resto === parseInt(cpf.substring(10, 11));
}

function ValidarCep(cep) {
    const regex = /^\d{5}-\d{3}$/;
    return regex.test(cep);
}

function ValidarUf(uf) {
    const ufsValidas = ["RJ", "ES", "SP", "BA", "MG", "PE", "RS"];
    return ufsValidas.includes(uf);
}

function ValidaForm(event) {
    event.preventDefault();
    let msg = "";

    const nome = document.getElementById("nome").value;
    const email = document.getElementById("email").value;
    const cpf = document.getElementById("cpf").value;
    const endereco = document.getElementById("endereco").value;
    const cep = document.getElementById("cep").value;
    const cidade = document.getElementById("cidade").value;
    const uf = document.getElementById("uf").value;

    // Validações individuais
    if (!ValidarNome(nome)) msg += "Nome não pode ser vazio!<br>";
    if (!ValidarEmail(email)) msg += "Email inválido!<br>";
    if (!ValidarCpf(cpf)) msg += "CPF inválido!<br>";
    if (!endereco.trim()) msg += "Endereço não pode ser vazio!<br>";
    if (!ValidarCep(cep)) msg += "CEP inválido! Use o formato 12345-678.<br>";
    if (!ValidarNome(cidade)) msg += "Cidade não pode ser vazia!<br>";
    if (!ValidarUf(uf)) msg += "UF inválida!<br>";

    // Exibe mensagem de erro
    document.getElementById("msgErro").innerHTML = msg;

    // Se não houver erros, enviar o formulário
    if (!msg) {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                alert("Formulário enviado com sucesso!");
                console.log("Resposta do servidor: " + this.responseText);
            } else if (this.readyState < 4) {
                console.log("Processando: " + this.readyState);
            } else {
                console.error("Erro na requisição: " + this.status);
            }
        };

        xmlhttp.open("POST", "http://localhost/3DAW/CRUDvalidacao/valida.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(
            "nome=" + encodeURIComponent(nome) +
            "&email=" + encodeURIComponent(email) +
            "&cpf=" + encodeURIComponent(cpf) +
            "&endereco=" + encodeURIComponent(endereco) +
            "&cep=" + encodeURIComponent(cep) +
            "&cidade=" + encodeURIComponent(cidade) +
            "&uf=" + encodeURIComponent(uf)
        );
    }
}
