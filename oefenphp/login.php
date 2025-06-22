<?php
session_start();
include "modules/database.php";
global $db;

$errors = [];

$admin_username = 'admin';
$admin_password = 'admin';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$username || !$password) {
        $errors[] = "Vul zowel gebruikersnaam als wachtwoord in.";
    } else {

        if ($username === $admin_username && $password === $admin_password) {
            $_SESSION['user_id'] = 0;
            $_SESSION['username'] = $admin_username;
            $_SESSION['role'] = 'admin';
            header("Location: dashboard.php");
            exit();
        }

        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            $errors[] = "Ongeldige gebruikersnaam of wachtwoord.";
        }
    }
}
?>
<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    
    <h1>Login</h1>
    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Gebruikersnaam</label><br>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required><br><br>

        <label for="password">Wachtwoord</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Inloggen</button>
    </form>
    <p>Nog geen account? <a href="sign-up.php">Registreer hier</a>.</p>
</body>

</html>