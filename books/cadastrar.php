<?php
require_once "../auth.php";
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: form.php");
    exit;
}

$campos = [
    'titulo' => 'Título',
    'autor' => 'Autor',
    'editora' => 'Editora',
    'sinopse' => 'Sinopse',
    'ano_pub' => 'Ano de Publicação',
    'genero' => 'Gênero',
    'paginas' => 'Número de Páginas',
];

$dados = [];
foreach ($campos as $campo => $label) {
    $valor = isset($_POST[$campo]) ? trim($_POST[$campo]) : '';
    if ($valor === '') {
        echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>O campo {$label} é obrigatório.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
        $conn->close();
        exit;
    }
    $dados[$campo] = $valor;
}

$stmt = $conn->prepare("INSERT INTO livros (Titulo, Autor, Editora, Sinopse, AnoPublicacao, Genero, Paginas) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $dados['titulo'], $dados['autor'], $dados['editora'], $dados['sinopse'], $dados['ano_pub'], $dados['genero'], $dados['paginas']);

if ($stmt->execute()) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Cadastro realizado</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Cadastro realizado</h3><hr></header><main class='container'><h2>Livro cadastrado com sucesso!</h2><p><a href='listar.php' class='button'>Listar livros</a></p><p><a href='form.php' class='button secondary'>Novo cadastro</a></p></main></body></html>";
} else {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro ao cadastrar livro.</h2><p>{$stmt->error}</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
}

$stmt->close();
$conn->close();
