<?php
include "../db.php";

$codleitor = filter_input(INPUT_GET, 'codleitor', FILTER_VALIDATE_INT);

if (!$codleitor) {
    header("Location: listar.php");
    exit;
}

$stmt = $conn->prepare("DELETE FROM leitores WHERE CodLeitor = ?");
$stmt->bind_param("i", $codleitor);

if ($stmt->execute()) {
    header("Location: listar.php?status=excluido");
    exit;
}

echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.html' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro na exclusão</h3><hr></header><main class='container'><h2>Erro ao excluir cadastro.</h2><p>{$stmt->error}</p><a href='listar.php' class='button'>Voltar</a></main></body></html>";
$stmt->close();
$conn->close();
