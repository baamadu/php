<?php
session_start();
include "modules/database.php";
global $db;

$article_id = filter_input(INPUT_GET, 'article_id', FILTER_SANITIZE_NUMBER_INT);

if (!$article_id) {
    echo "Geen artikel geselecteerd.";
    exit;
}

$stmt = $db->prepare("SELECT title, news FROM articles WHERE id = :id");
$stmt->bindParam(':id', $article_id, PDO::PARAM_INT);
$stmt->execute();
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "Artikel niet gevonden.";
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Nieuws</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <span class="nav-link">Welkom, <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?></span>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Inloggen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sign-up.php">Registreren</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <p><?= nl2br(htmlspecialchars($article['news'])) ?></p>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Terug</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>