<?php
include "config.php";

// Consulta para obter todos os leitores para a caixa suspensa
$sql_leitores = "SELECT CodLeitor, Nome FROM leitores ORDER BY Nome";
$result_leitores = mysqli_query($conn, $sql_leitores);

// Verifica se um leitor foi selecionado
$leitor_selecionado = isset($_POST['codleitor']) ? $_POST['codleitor'] : null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos por Leitor</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .sem-emprestimos {
            text-align: center;
            padding: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <a href="index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">CONSULTA DE EMPRÉSTIMOS POR LEITOR</h3>
        <hr>
    </header>
    <div class="container">
        <!-- Formulário para selecionar o leitor -->
        <form method="post" action="">
            <div>
                <label for="codleitor">Selecione o Leitor:</label>
                <select id="codleitor" name="codleitor" onchange="this.form.submit()">
                    <option value="">Selecione um leitor</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($result_leitores)) {
                        $selected = ($leitor_selecionado == $row['CodLeitor']) ? 'selected' : '';
                        echo "<option value='" . $row['CodLeitor'] . "' $selected>" . 
                             $row['CodLeitor'] . " - " . $row['Nome'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </form>

        <?php
        if ($leitor_selecionado) {
            // Consulta para obter os empréstimos do leitor selecionado
            $sql_emprestimos = "
                SELECT e.CodEmprestimo, 
                       l.Nome AS NomeLeitor,
                       liv.Titulo AS TituloLivro,
                       e.Data_Emprestimo,
                       e.Data_Devolucao
                FROM emprestimos e
                JOIN leitores l ON e.CodLeitor = l.CodLeitor
                JOIN livros liv ON e.CodLivro = liv.CodLivro
                WHERE e.CodLeitor = $leitor_selecionado
                ORDER BY e.Data_Emprestimo DESC";

            $result_emprestimos = mysqli_query($conn, $sql_emprestimos);

            if (mysqli_num_rows($result_emprestimos) > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Leitor</th>
                                <th>Livro</th>
                                <th>Data Empréstimo</th>
                                <th>Data Devolução</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($emprestimo = mysqli_fetch_assoc($result_emprestimos)) {
                    // Formatando as datas para o padrão brasileiro
                    $data_emprestimo = date("d/m/Y", strtotime($emprestimo['Data_Emprestimo']));
                    $data_devolucao = date("d/m/Y", strtotime($emprestimo['Data_Devolucao']));
                    
                    // Verificando o status do empréstimo
                    $hoje = new DateTime();
                    $devolucao = new DateTime($emprestimo['Data_Devolucao']);
                    

                    echo "<tr>
                            <td>{$emprestimo['CodEmprestimo']}</td>
                            <td>{$emprestimo['NomeLeitor']}</td>
                            <td>{$emprestimo['TituloLivro']}</td>
                            <td>{$data_emprestimo}</td>
                            <td>{$data_devolucao}</td>
                            
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='sem-emprestimos'>Nenhum empréstimo encontrado para este leitor.</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>