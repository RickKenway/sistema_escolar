<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM Professor WHERE Email = '$email' AND Senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuário autenticado
        $professor = $result->fetch_assoc();
        $_SESSION['ID_Professor'] = $professor['ID_Professor'];
        $_SESSION['Nome'] = $professor['Nome'];
        header("Location: ../professor.php");  // Redireciona para a tela principal do professor
    } else {
        // Autenticação falhou
        $_SESSION['error'] = "Email ou senha incorretos";
        header("Location: ../index.php");  // Redireciona para a tela de login
    }
}
?>
