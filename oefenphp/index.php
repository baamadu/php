<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Het nieuws</title>
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

    <?php
    include "modules/database.php";
    global $db;

    try {
        $query = $db->query("SELECT id, name FROM categories");
        $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Fout bij het ophalen van categorieën: " . htmlspecialchars($e->getMessage()) . "</div>";
        $categories = [];
    }
    ?>

    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h1>Nieuws Categorieën</h1>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="add-news.php" class="btn btn-success">Nieuws toevoegen</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">Inloggen</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    <?php foreach ($categories as $category): ?>
                        <li class="list-group-item">
                            <a href="news.php?category_id=<?= htmlspecialchars($category['id']) ?>" class="text-decoration-none">
                                <?= htmlspecialchars(ucfirst($category['name'])) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="logout.php" class="btn btn-danger">Uitloggen</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
