<?php
require_once "../auth.php";
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
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>{$erro}</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $conn->close();
    exit;
}

$stmt = $conn->prepare("INSERT INTO leitores (Nome, DtNasc, Celular, Email, RA, Endereco, NumEnd, Bairro, CidadeUF) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $dados['nome'], $dados['dtnasc'], $dados['celular'], $dados['email'], $dados['ra'], $dados['endereco'], $dados['num_end'], $dados['bairro'], $dados['cidade']);

if ($stmt->execute()) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Cadastro realizado</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Cadastro realizado</h3><hr></header><main class='container'><h2>Cadastro realizado com sucesso!</h2><p><a href='listar.php' class='button'>Listar leitores</a></p><p><a href='form.php' class='button secondary'>Novo cadastro</a></p></main></body></html>";
} else {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro ao cadastrar.</h2><p>{$stmt->error}</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
}

$stmt->close();
$conn->close();
