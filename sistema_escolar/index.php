<?php include 'includes/header.php'; ?>

<div class="login-container">
    <h2>Login do Professor</h2>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<div class='error'>{$_SESSION['error']}</div>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="includes/auth.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <input type="submit" value="Entrar">
    </form>
</div>

<?php include 'includes/footer.php'; ?>
