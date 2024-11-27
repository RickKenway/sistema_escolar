<?php
session_start();
if (!isset($_SESSION['ID_Professor'])) {
    header("Location: ../index.php");
    exit;
}
require '../includes/db.php';

// Verificar se uma turma foi passada via GET (para associar a atividade à turma)
if (!isset($_GET['id'])) {
    header("Location: ../professor.php");
    exit;
}

$id_turma = $_GET['id'];

// Processar o formulário de cadastro de atividade
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];

    // Inserir a nova atividade no banco de dados
    $sql = "INSERT INTO Atividade (Descricao, ID_Turma) VALUES ('$descricao', '$id_turma')";
    if ($conn->query($sql)) {
        header("Location: listar.php?id=$id_turma"); // Redireciona para a lista de atividades da turma
    } else {
        echo "Erro ao cadastrar atividade.";
    }
}
?>

<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../assets/css/style.css">
<div class="dashboard-container">
    <h2>Cadastrar Nova Atividade</h2>

    <a href="../professor.php" class="btn-back">Voltar para a tela principal</a>

    <div class="form-container">
        <form action="" method="POST">
            <label for="descricao">Cadastrar Nova Atividade:</label>
            <input type="text" id="descricao" name="descricao" placeholder="(Digite aqui)" required>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
