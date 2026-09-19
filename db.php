<?php
// Configuração do banco de dados
$db_host = "127.0.0.1"; // Hostname do servidor de banco de dados
$db_port = 3308; // Porta utilizada pelo MariaDB/MySQL no XAMPP
$db_user = "root"; // Nome de usuário para conectar ao banco de dados
$db_pass = ""; // Senha para conectar ao banco de dados (vazio significa sem senha)
$db_name = "db_biblioteca"; // Nome do banco de dados a conectar

// Conectar ao banco de dados
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: {$conn->connect_error}");
}
