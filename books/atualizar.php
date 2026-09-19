<?php
require_once "../auth.php";
include "../db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listar.php");
    exit;
}

$campos = [
    'codlivro' => 'Código',
    'titulo' => 'Título',
    'autor' => 'Autor',
    'editora' => 'Editora',
    'sinopse' => 'Sinopse',
    'ano_pub' => 'Ano de Publicação',
    'genero' => 'Gênero',
    'paginas' => 'Número de Páginas',
];

foreach ($campos as $campo => $label) {
    if (!isset($_POST[$campo]) || trim($_POST[$campo]) === '') {
        echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro na atualização</h3><hr></header><main class='container'><h2>Erro</h2><p>O campo {$label} é obrigatório.</p><a href='listar.php' class='button'>Voltar</a></main></body></html>";
        $conn->close();
        exit;
    }
}

$codlivro = (int) $_POST['codlivro'];
$titulo = trim($_POST['titulo']);
$autor = trim($_POST['autor']);
$editora = trim($_POST['editora']);
$sinopse = trim($_POST['sinopse']);
$ano_pub = trim($_POST['ano_pub']);
$genero = trim($_POST['genero']);
$paginas = trim($_POST['paginas']);

$stmt = $conn->prepare("UPDATE livros SET Titulo = ?, Autor = ?, Editora = ?, Sinopse = ?, AnoPublicacao = ?, Genero = ?, Paginas = ? WHERE CodLivro = ?");
$stmt->bind_param("sssssssi", $titulo, $autor, $editora, $sinopse, $ano_pub, $genero, $paginas, $codlivro);

if ($stmt->execute()) {
    header("Location: listar.php?status=atualizado");
    exit;
}

echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro na atualização</h3><hr></header><main class='container'><h2>Erro ao atualizar livro.</h2><p>{$stmt->error}</p><a href='listar.php' class='button'>Voltar</a></main></body></html>";
$stmt->close();
$conn->close();
