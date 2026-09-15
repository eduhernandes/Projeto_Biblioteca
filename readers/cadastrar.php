<?php
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

$campos = [
    'nome' => 'Nome',
    'dtnasc' => 'Data de Nascimento',
    'celular' => 'Celular',
    'email' => 'E-mail',
    'ra' => 'RA',
    'endereco' => 'Endereço',
    'num_end' => 'Número',
    'bairro' => 'Bairro',
    'cidade' => 'Cidade',
];

$dados = [];
foreach ($campos as $campo => $label) {
    $valor = isset($_POST[$campo]) ? trim($_POST[$campo]) : '';
    if ($valor === '') {
        $erro = "O campo {$label} é obrigatório.";
        break;
    }
    $dados[$campo] = $valor;
}

if (isset($erro)) {
    echo "<h2>Erro</h2><p>{$erro}</p><a href='form.php'><button>Voltar</button></a>";
    $conn->close();
    exit;
}

$stmt = $conn->prepare("INSERT INTO leitores (Nome, DtNasc, Celular, Email, RA, Endereco, NumEnd, Bairro, CidadeUF) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $dados['nome'], $dados['dtnasc'], $dados['celular'], $dados['email'], $dados['ra'], $dados['endereco'], $dados['num_end'], $dados['bairro'], $dados['cidade']);

if ($stmt->execute()) {
    echo "<center><h1>Cadastro realizado com sucesso!</h1><br>
          <a href='index.php'><button>Listar leitores</button></a>
          <a href='form.php'><button>Novo cadastro</button></a></center>";
} else {
    echo "<center><h1>Erro ao cadastrar.</h1><br>
          <p>{$stmt->error}</p>
          <a href='form.php'><button>Voltar</button></a></center>";
}

$stmt->close();
$conn->close();
