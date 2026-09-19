<?php
session_start();
require_once __DIR__ . '/db.php';

if (!empty($_SESSION['usuario_id'])) {
    header('Location: /Projeto_Biblioteca/index.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $erro = 'Informe seu e-mail e sua senha.';
    } else {
        $stmt = $conn->prepare('SELECT CodUsuario, Nome, Email, Senha, Tipo FROM usuarios WHERE Email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado && $resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();

            if (password_verify($senha, $usuario['Senha'])) {
                session_regenerate_id(true);
                $_SESSION['usuario_id'] = (int) $usuario['CodUsuario'];
                $_SESSION['usuario_nome'] = $usuario['Nome'];
                $_SESSION['usuario_email'] = $usuario['Email'];
                $_SESSION['usuario_tipo'] = $usuario['Tipo'];

                $destino = $_SESSION['redirect_after_login'] ?? '/Projeto_Biblioteca/index.php';
                unset($_SESSION['redirect_after_login']);

                header('Location: ' . $destino);
                exit;
            }
        }

        $erro = 'E-mail ou senha inválidos.';
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1 class="text-center">Sistema Biblioteca</h1>
        <h3 class="text-center">Login</h3>
    </header>

    <main class="container">
        <form method="post" action="login.php">
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            </div>

            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($erro); ?>
                </div>
            <?php endif; ?>

            <div>
                <button type="submit">Entrar</button>
            </div>
        </form>
    </main>
</body>
</html>
