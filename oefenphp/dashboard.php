<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: sign-in.php');
    exit;
}

$username = $_SESSION['username'];
$role = $_SESSION['role'] ?? 'user';
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-5">
        <?php if ($role === 'admin'): ?>
            <h1>YOU LOGGED IN AS ADMIN</h1>
            <p>Welkom, <?= htmlspecialchars($username) ?>!</p>
        <?php else: ?>
            <h1>Welkom, <?= htmlspecialchars($username) ?>!</h1>
        <?php endif; ?>
        <p>Je bent ingelogd op het dashboard.</p>
        <a href="index.php" class="btn btn-danger">Gaa nieuws kijken!</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>