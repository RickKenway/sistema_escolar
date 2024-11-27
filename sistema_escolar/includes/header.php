<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'Sistema Escolar'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
    <div class="header-container">
        <h1>Sistema Escolar</h1>
        <?php if (isset($_SESSION['ID_Professor'])): ?>
            <nav>
                <ul>
                    <li><a href="professor.php">Home</a></li>
                    <li><a href="index.php">Sair</a></li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</header>
