<?php
session_start();
if (!isset($_SESSION['ID_Professor'])) {
    header("Location: index.php");
    exit;
}
require 'includes/db.php';
?>

<?php include 'includes/header.php'; ?>

<div class="dashboard-container">
    <h2>Bem-vindo, <?php echo $_SESSION['Nome']; ?></h2>
    
    <div class="turmas-container">
        <h3>Suas Turmas:</h3>

        <div class="turmas-grid">
        <?php
        $id_professor = $_SESSION['ID_Professor'];
        $sql = "SELECT * FROM Turma WHERE ID_Professor = $id_professor";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($turma = $result->fetch_assoc()) {
                echo "<div class='turma-card'>
                        <h4>{$turma['Nome_Turma']}</h4>
                        <a href='atividades/listar.php?id={$turma['ID_Turma']}' class='btn-atividades'>Ver atividades</a>
                        <a href='turmas/excluir.php?id={$turma['ID_Turma']}' class='btn-excluir' onclick='return confirmarExclusao(\"{$turma['Nome_Turma']}\")'>
                            Excluir
                        </a>
                    </div>";
            }
        } else {
            echo "<p>Você ainda não tem turmas cadastradas.</p>";
        }
        ?>
        </div>

        <!-- Botão para adicionar nova turma com o texto ao lado do "+" -->
        <a href="turmas/cadastro.php" class="btn-add-turma">Adicionar Turma +</a>
    </div>
</div>

<script src="assets/js/script.js"></script>

<?php include 'includes/footer.php'; ?> 