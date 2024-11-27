<?php
session_start();
if (!isset($_SESSION['ID_Professor'])) {
    header("Location: ../index.php");
    exit;
}
require '../includes/db.php';

// Processar o formulário de cadastro de turma
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_turma = $_POST['nome_turma'];
    $id_professor = $_SESSION['ID_Professor'];

    // Inserir a nova turma no banco de dados
    $sql = "INSERT INTO Turma (Nome_Turma, ID_Professor) VALUES ('$nome_turma', '$id_professor')";
    if ($conn->query($sql)) {
        header("Location: ../professor.php"); // Redireciona para a lista de turmas
    } else {
        echo "Erro ao cadastrar a turma.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/style.css">
<div class="dashboard-container">
    <h2>Cadastrar Nova Turma</h2>

    <a href="../professor.php" class="btn-back">Voltar para a tela principal</a>

    <div class="form-container">
        <form action="" method="POST">
            <label for="nome_turma">Cadastrar Nova Turma:</label>
            <input type="text" id="nome_turma" name="nome_turma" placeholder="(Digite aqui)" required>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
