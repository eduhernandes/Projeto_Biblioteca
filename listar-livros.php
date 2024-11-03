<!DOCTYPE html>
<html>
<head>
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.html"><button title="Voltar ao início">Home</button></a>
            <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
            <h3 class="text-center">Leitores Cadastrados</h3>
        <hr>
    </header>
   <main>
   <?php
    include "config.php";

    $sql = "SELECT * FROM livros";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            echo $linha['CodLivro']. " - ". $linha['Titulo']. "<br>";
        }
    } else {
        echo "0 resultados";
    }
   ?>

    <form method="post" action="form-altera-livros.php">
        <table border="0">
            <tr>
                <td bgcolor="#cccccc" class="myinputstyle" size="3">Código:</td>
                <td bgcolor="#EBEBEB">
                    <input type="text" name="codlivro" size="3" class="myinputstyle"
                           title="Digite código do livro" required onchange="this.value = this.value.trim()"> &nbsp;
                    <button type="submit" name="alterar_livro">Alterar Contato</button>
                </td>
            </tr>
        </table>
    </form>
   </main>
</body>
</html>