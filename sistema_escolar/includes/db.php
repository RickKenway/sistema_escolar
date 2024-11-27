<?php
$servername = "localhost";
$username = "root";  // ou seu usuário MySQL
$password = "";      // senha do MySQL
$dbname = "sistema_escolar";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
