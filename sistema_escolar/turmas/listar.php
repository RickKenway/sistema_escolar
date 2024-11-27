<?php
session_start();
if (!isset($_SESSION['ID_Professor'])) {
    header("Location: ../index.php");
    exit;
}
require '../includes/db.php';

// Verificar se o ID da turma foi passado via GET
if (!isset($_GET['id'])) {
    header("Location: ../professor.php");
    exit;
}

$id_turma = $_GET['id'];

// Recuperar o nome da turma e validar que a turma pertence ao professor autenticado
$sql_turma = "SELECT Nome_Turma FROM Turma WHERE ID_Turma = $id_turma AND ID_Professor = {$_SESSION['ID_Professor']}";
$result_turma = $conn->query($sql_turma);
if ($result_turma->num_rows == 0) {
    echo "Turma não encontrada ou você não tem permissão para visualizá-la.";
    exit;
}
$turma = $result_turma->fetch_assoc();

// Listar atividades da turma
$sql = "SELECT * FROM Atividade WHERE ID_Turma = $id_turma";
$result = $conn->query($sql);
?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-container">
    <h2>Atividades da Turma: <?php echo $turma['Nome_Turma']; ?></h2>

    <!-- Listar atividades -->
    <ul>
    <?php
    if ($result->num_rows > 0) {
        while ($atividade = $result->fetch_assoc()) {
            echo "<li>Atividade: {$atividade['Descricao']}</li>";
        }
    } else {
        echo "<p>Não há atividades cadastradas para esta turma.</p>";
    }
    ?>
    </ul>

    <!-- Link para cadastrar nova atividade -->
    <a href="cadastro.php?id=<?php echo $id_turma; ?>">Cadastrar nova atividade</a>
    <!-- Link para voltar à tela principal -->
    <a href="../professor.php">Voltar para a tela principal</a>
</div>

<?php include '../includes/footer.php'; ?>
