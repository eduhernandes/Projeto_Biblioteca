<?php
include "../db.php";

$codlivro = filter_input(INPUT_GET, 'codlivro', FILTER_VALIDATE_INT);

if (!$codlivro) {
    header("Location: listar.php");
    exit;
}

$sql = "SELECT * FROM livros WHERE CodLivro = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $codlivro);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<h2>Livro não encontrado.</h2><a href='listar.php'><button>Voltar</button></a>";
    $stmt->close();
    $conn->close();
    exit;
}

$livro = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Editar livro</h3>
        <hr>
    </header>

    <main class="container">
        <form action="atualizar.php" method="post">
            <div>
                <label for="codlivro">Código:</label>
                <input type="text" id="codlivro" name="codlivro" readonly value="<?php echo htmlspecialchars($livro['CodLivro']); ?>" required />
            </div>
            <div>
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['Titulo']); ?>" required />
            </div>
            <div>
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($livro['Autor']); ?>" required />
            </div>
            <div>
                <label for="editora">Editora:</label>
                <input type="text" id="editora" name="editora" value="<?php echo htmlspecialchars($livro['Editora']); ?>" required />
            </div>
            <div>
                <label for="sinopse">Sinopse:</label>
                <textarea id="sinopse" name="sinopse" required><?php echo htmlspecialchars($livro['Sinopse']); ?></textarea>
            </div>
            <div>
                <label for="ano_pub">Ano de Publicação:</label>
                <input type="number" id="ano_pub" name="ano_pub" value="<?php echo htmlspecialchars($livro['AnoPublicacao']); ?>" required />
            </div>
            <div>
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="<?php echo htmlspecialchars($livro['Genero']); ?>" required />
            </div>
            <div>
                <label for="paginas">Número de Páginas:</label>
                <input type="number" id="paginas" name="paginas" value="<?php echo htmlspecialchars($livro['Paginas']); ?>" required />
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
