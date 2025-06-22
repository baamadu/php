<?php
session_start();
include "modules/database.php";
global $db;

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo '<div style="margin:2rem; font-weight:bold; color:red;">Je hebt geen toestemming om nieuws toe te voegen.</div>';
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $category_id = intval($_POST['category_id'] ?? 0);

    if (!$title || !$content || !$category_id) {
        $message = "Vul alle velden correct in.";
    } else {
        try {
            $stmt = $db->prepare("INSERT INTO articles (title, news, category_id) VALUES (?, ?, ?)");
            $stmt->execute([$title, $content, $category_id]);
            $message = "Nieuwsartikel succesvol toegevoegd!";
        } catch (PDOException $e) {
            $message = "Fout bij het toevoegen van het nieuwsartikel: " . htmlspecialchars($e->getMessage());
        }
    }
}

try {
    $stmt = $db->query("SELECT id, name FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $categories = [];
    $message = "Fout bij het ophalen van categorieën.";
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nieuw Artikel Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-5">
        <h1>Nieuw Artikel Toevoegen</h1>

        <?php if ($message): ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label for="title" class="form-label">Titel</label>
                <input type="text" class="form-control" id="title" name="title" required />
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Inhoud</label>
                <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categorie</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled selected>-- Kies een categorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>"><?= htmlspecialchars(ucfirst($cat['name'])) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Toevoegen</button>
            <button type="button" class="btn btn-secondary ms-2" onclick="window.location.href='index.php'">Terug naar niews</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>