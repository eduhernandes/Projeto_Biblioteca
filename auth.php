<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuarioLogado(): bool
{
    return !empty($_SESSION['usuario_id']);
}

function usuarioTemPermissao(array $tiposPermitidos): bool
{
    $tipoAtual = $_SESSION['usuario_tipo'] ?? '';
    return in_array($tipoAtual, $tiposPermitidos, true);
}

function requireLogin(): void
{
    if (!usuarioLogado()) {
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? '/Projeto_Biblioteca/index.php';
        header('Location: /Projeto_Biblioteca/login.php');
        exit;
    }
}

function requirePermission(array $tiposPermitidos, string $mensagem = 'Você não tem permissão para acessar esta página.'): void
{
    if (!usuarioLogado() || !usuarioTemPermissao($tiposPermitidos)) {
        $_SESSION['erro_permissao'] = $mensagem;
        header('Location: /Projeto_Biblioteca/index.php');
        exit;
    }
}

requireLogin();
