<?php
require_once __DIR__ . '/../auth.php';
requirePermission(['admin']);
include __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$tipo = $_POST['tipo'] ?? '';

$tiposPermitidos = ['admin', 'bibliotecario', 'usuario'];

if ($nome === '' || $email === '' || $senha === '' || !in_array($tipo, $tiposPermitidos, true)) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.php' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>Preencha todos os campos corretamente.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $conn->close();
    exit;
}

if (strlen($senha) < 6) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.php' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>A senha deve ter pelo menos 6 caracteres.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $conn->close();
    exit;
}

$stmtVerifica = $conn->prepare('SELECT CodUsuario FROM usuarios WHERE Email = ? LIMIT 1');
$stmtVerifica->bind_param('s', $email);
$stmtVerifica->execute();
$resultado = $stmtVerifica->get_result();

if ($resultado->num_rows > 0) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.php' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro</h2><p>Já existe um usuário com este e-mail.</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
    $stmtVerifica->close();
    $conn->close();
    exit;
}

$stmtVerifica->close();

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);
$stmt = $conn->prepare('INSERT INTO usuarios (Nome, Email, Senha, Tipo, Status, DataCadastro) VALUES (?, ?, ?, ?, ?, NOW())');
$stmt->bind_param('sssss', $nome, $email, $senhaHash, $tipo, $status);
$status = 'ativo';

if ($stmt->execute()) {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Cadastro realizado</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.php' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Cadastro realizado</h3><hr></header><main class='container'><h2>Usuário cadastrado com sucesso!</h2><p><a href='listar.php' class='button'>Listar usuários</a></p><p><a href='form.php' class='button secondary'>Novo cadastro</a></p></main></body></html>";
} else {
    echo "<!DOCTYPE html><html lang='pt-BR'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'><title>Erro</title><link rel='stylesheet' href='../style.css'></head><body><header><a href='../index.php' class='button secondary' title='Voltar ao início'>Home</a><h1 class='text-center'>SISTEMA BIBLIOTECA</h1><h3 class='text-center'>Erro no cadastro</h3><hr></header><main class='container'><h2>Erro ao cadastrar usuário.</h2><p>{$stmt->error}</p><a href='form.php' class='button'>Voltar</a></main></body></html>";
}

$stmt->close();
$conn->close();
