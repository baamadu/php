<?php
session_start();
include "modules/database.php";
global $db;

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);

if (!$category_id) {
    echo "Geen categorie geselecteerd.";
    exit;
}


$stmtCat = $db->prepare("SELECT name FROM categories WHERE id = :id");
$stmtCat->bindParam(':id', $category_id, PDO::PARAM_INT);
$stmtCat->execute();
$category = $stmtCat->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    echo "Categorie niet gevonden.";
    exit;
}


$stmt = $db->prepare("SELECT id, title FROM articles WHERE category_id = :category_id");
$stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nieuws in categorie: <?= htmlspecialchars(ucfirst($category['name'])) ?></title>
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
        <h1>Nieuws in categorie: <?= htmlspecialchars(ucfirst($category['name'])) ?></h1>

        <?php if (count($articles) === 0): ?>
            <p>Er zijn geen nieuwsberichten in deze categorie.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($articles as $article): ?>
                    <li class="list-group-item">
                        <a href="news-article.php?article_id=<?= htmlspecialchars($article['id']) ?>" class="text-decoration-none">
                            <?= htmlspecialchars($article['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a href="index.php" class="btn btn-secondary mt-3">Terug naar categorieën</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>