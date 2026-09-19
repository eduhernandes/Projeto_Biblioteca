<?php
require_once "../auth.php";
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

$campos = [
    'codleitor' => 'Leitor',
    'codlivro' => 'Livro',
    'data_emprestimo' => 'Data do Empréstimo',
    'data_devolucao' => 'Data de Devolução',
];

foreach ($campos as $campo => $label) {
    if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>O campo {$label} é obrigatório.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
        $conn->close();
        exit;
    }
}

$codleitor = (int) $_POST['codleitor'];
$codlivro = (int) $_POST['codlivro'];
$data_emprestimo = trim($_POST['data_emprestimo']);
$data_devolucao = trim($_POST['data_devolucao']);

$checkLeitor = $conn->prepare("SELECT CodLeitor FROM leitores WHERE CodLeitor = ?");
$checkLeitor->bind_param("i", $codleitor);
$checkLeitor->execute();
$leitorExiste = $checkLeitor->get_result()->num_rows;
$checkLeitor->close();

$checkLivro = $conn->prepare("SELECT CodLivro FROM livros WHERE CodLivro = ?");
$checkLivro->bind_param("i", $codlivro);
$checkLivro->execute();
$livroExiste = $checkLivro->get_result()->num_rows;
$checkLivro->close();

if ($leitorExiste === 0) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>Leitor não encontrado.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $conn->close();
    exit;
}

if ($livroExiste === 0) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>Livro não encontrado.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $conn->close();
    exit;
}

$stmt = $conn->prepare("INSERT INTO emprestimos (CodLeitor, CodLivro, Data_Emprestimo, Data_Devolucao) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $codleitor, $codlivro, $data_emprestimo, $data_devolucao);

if ($stmt->execute()) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Cadastro realizado</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Cadastro realizado</h3><hr></header><main class='container'><h2>Empréstimo cadastrado com sucesso!</h2><p><a href='listar.php' class='button'>Listar empréstimos</a></p><p><a href='form.php' class='button secondary'>Novo cadastro</a></p></main></body></html>";
} else {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro ao cadastrar empréstimo.</h2><p>{$stmt->error}</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
}

$stmt->close();
$conn->close();
