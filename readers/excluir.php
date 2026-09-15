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

echo "<h2>Erro ao excluir cadastro.</h2><p>{$stmt->error}</p><a href='listar.php'><button>Voltar</button></a>";
$stmt->close();
$conn->close();
