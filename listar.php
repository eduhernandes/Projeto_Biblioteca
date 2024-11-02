<!DOCTYPE html>
<html>
<head>
    <title>Agenda de Contatos</title>
    <!--criando estilo css -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.html"><button title="Homepage">Voltar</button></a>
    <center>
        <h1>SISTEMA BIBLIOTECA</h1>
        <h3>Leitores Cadastrados</h3>
    </center>
    <hr>

    <?php
    include "config.php";

    $sql = "SELECT * FROM leitores";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($linha = mysqli_fetch_assoc($result)) {
            echo $linha['CodLeitor']. " - ". $linha['Nome']. "<br>";
        }
    } else {
        echo "0 resultados";
    }
   ?>

    <form method="post" action="form-altera-leitores.php">
        <table border="0">
            <tr>
                <td bgcolor="#cccccc" class="myinputstyle" size="3">Código:</td>
                <td bgcolor="#EBEBEB">
                    <input type="text" name="codleitor" size="3" class="myinputstyle"
                           title="Digite código do contato" required onchange="this.value = this.value.trim()"> &nbsp;
                    <button type="submit" name="alterar_contato">Alterar Contato</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>