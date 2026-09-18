<?php
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listar.php");
    exit;
}

$campos = [
    'codleitor' => 'Código',
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

foreach ($campos as $campo => $label) {
    if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro na atualização</h3><hr></header><main class='container'><h2>Erro</h2><p>O campo {$label} é obrigatório.</p><a href='listar.php' class='button'>Voltar</a></main></body></html>";
        $conn->close();
        exit;
    }
}

$codleitor = (int) $_POST['codleitor'];
$nome = trim($_POST['nome']);
$dtnasc = trim($_POST['dtnasc']);
$celular = trim($_POST['celular']);
$email = trim($_POST['email']);
$ra = trim($_POST['ra']);
$endereco = trim($_POST['endereco']);
$num_end = trim($_POST['num_end']);
$bairro = trim($_POST['bairro']);
$cidade = trim($_POST['cidade']);

$stmt = $conn->prepare("UPDATE leitores SET Nome = ?, DtNasc = ?, Celular = ?, Email = ?, RA = ?, Endereco = ?, NumEnd = ?, Bairro = ?, CidadeUF = ? WHERE CodLeitor = ?");
$stmt->bind_param("sssssssssi", $nome, $dtnasc, $celular, $email, $ra, $endereco, $num_end, $bairro, $cidade, $codleitor);

if ($stmt->execute()) {
    header("Location: listar.php?status=atualizado");
    exit;
}

echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro na atualização</h3><hr></header><main class='container'><h2>Erro ao atualizar cadastro.</h2><p>{$stmt->error}</p><a href='listar.php' class='button'>Voltar</a></main></body></html>";
$stmt->close();
$conn->close();
