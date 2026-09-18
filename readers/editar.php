<?php
include "../db.php";

$codleitor = filter_input(INPUT_GET, 'codleitor', FILTER_VALIDATE_INT);

if (!$codleitor) {
    header("Location: listar.php");
    exit;
}

$sql = "SELECT * FROM leitores WHERE CodLeitor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codleitor);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2>Leitor não encontrado.</h2><a href='listar.php'><button>Voltar</button></a>";
    $stmt->close();
    $conn->close();
    exit;
}

$leitor = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Leitor</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Editar leitor</h3>
        <hr>
    </header>

    <main class="container">
        <form action="atualizar.php" method="post">
            <div>
                <label for="codleitor">Código:</label>
                <input type="text" id="codleitor" name="codleitor" readonly value="<?php echo htmlspecialchars($leitor['CodLeitor']); ?>" required />
            </div>
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($leitor['Nome']); ?>" required />
            </div>
            <div>
                <label for="dtnasc">Data de Nascimento:</label>
                <input type="date" id="dtnasc" name="dtnasc" value="<?php echo htmlspecialchars($leitor['DtNasc']); ?>" required />
            </div>
            <div>
                <label for="celular">Celular:</label>
                <input type="tel" id="celular" name="celular" value="<?php echo htmlspecialchars($leitor['Celular']); ?>" required />
            </div>
            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($leitor['Email']); ?>" required />
            </div>
            <div>
                <label for="ra">RA:</label>
                <input type="text" id="ra" name="ra" value="<?php echo htmlspecialchars($leitor['RA']); ?>" required />
            </div>
            <div>
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($leitor['Endereco']); ?>" required />
            </div>
            <div>
                <label for="num_end">Número:</label>
                <input type="number" id="num_end" name="num_end" value="<?php echo htmlspecialchars($leitor['NumEnd']); ?>" required />
            </div>
            <div>
                <label for="bairro">Bairro:</label>
                <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($leitor['Bairro']); ?>" required />
            </div>
            <div>
                <label for="cidade">Cidade:</label>
                <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($leitor['CidadeUF']); ?>" required />
            </div>
            <div>
                <button type="submit">Atualizar</button>
                <a href="listar.php" class="button secondary">Cancelar</a>
            </div>
        </form>
    </main>
</body>
</html>

<?php $conn->close(); ?>
