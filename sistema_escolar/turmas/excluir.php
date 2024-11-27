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

// Verificar se a turma pertence ao professor autenticado
$sql_turma = "SELECT * FROM Turma WHERE ID_Turma = $id_turma AND ID_Professor = {$_SESSION['ID_Professor']}";
$result_turma = $conn->query($sql_turma);
if ($result_turma->num_rows == 0) {
    echo "Turma não encontrada ou você não tem permissão para excluí-la.";
    exit;
}

// Verificar se a turma tem atividades cadastradas
$sql_atividades = "SELECT * FROM Atividade WHERE ID_Turma = $id_turma";
$result_atividades = $conn->query($sql_atividades);

if ($result_atividades->num_rows > 0) {
    // Excluir todas as atividades associadas à turma
    $sql_excluir_atividades = "DELETE FROM Atividade WHERE ID_Turma = $id_turma";
    $conn->query($sql_excluir_atividades);
}

// Excluir a turma após remover as atividades
$sql_excluir = "DELETE FROM Turma WHERE ID_Turma = $id_turma";
if ($conn->query($sql_excluir)) {
    header("Location: ../professor.php?msg=turma_excluida");
} else {
    echo "Erro ao excluir a turma.";
}
?>
