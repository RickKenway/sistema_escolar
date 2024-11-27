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

// Recuperar o nome da turma
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
<link rel="stylesheet" href="../assets/css/style.css">
<div class="dashboard-container">
    <h2>Atividades da <?php echo $turma['Nome_Turma']; ?></h2>

    <a href="../professor.php" class="btn-back">Voltar para a tela principal</a>

    <div class="atividades-grid">
    <?php
    if ($result->num_rows > 0) {
        $index = 1;
        while ($atividade = $result->fetch_assoc()) {
            echo "<div class='atividade-card'>
                    <h4>Atividade - $index</h4>
                    <p>{$atividade['Descricao']}</p>
                  </div>";
            $index++;
        }
    } else {
        echo "<p>Não há atividades cadastradas para esta turma.</p>";
    }
    ?>
    </div>

    <!-- Botão para adicionar nova atividade com texto ao lado do "+" -->
    <a href="cadastro.php?id=<?php echo $id_turma; ?>" class="btn-add-atividade">Adicionar Atividade +</a>

</div>

<?php include '../includes/footer.php'; ?>