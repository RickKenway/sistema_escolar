// Função para confirmar exclusão de uma turma
function confirmarExclusao(nomeTurma) {
    return confirm(`Tem certeza que deseja excluir a turma: ${nomeTurma}? Essa ação não pode ser desfeita.`);
}

// Validação de formulários
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('form');
    
    // Exemplo de validação simples para garantir que os campos não estão vazios
    form.addEventListener('submit', function (event) {
        const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');
        let valid = true;

        inputs.forEach(function (input) {
            if (input.value.trim() === "") {
                valid = false;
                input.style.borderColor = "red";
                alert(`O campo ${input.getAttribute('name')} é obrigatório.`);
            } else {
                input.style.borderColor = ""; // Reseta a cor do campo caso esteja preenchido
            }
        });

        if (!valid) {
            event.preventDefault(); // Impede o envio do formulário se a validação falhar
        }
    });
});
