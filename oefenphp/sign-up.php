<?php
include "modules/database.php";
global $db;

session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$username) {
        $errors[] = "Vul een gebruikersnaam in.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Vul een geldig e-mailadres in.";
    }
    if (!$password || strlen($password) < 6) {
        $errors[] = "Het wachtwoord moet minimaal 6 tekens lang zijn.";
    }

    if (empty($errors)) {

        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            $errors[] = "Gebruikersnaam is al in gebruik.";
        }

        if (empty($errors)) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, 'member')");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);

            if ($stmt->execute()) {

                header('Location: login.php');
                exit();
            } else {
                $errors[] = "Er is iets misgegaan bij het registreren. Probeer het later opnieuw.";
            }
        }
    }
}
?>

<!doctype html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>

<body>
    
    <h1>Registreer</h1>

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

        <label for="email">E-mailadres</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required><br><br>

        <label for="password">Wachtwoord</label><br>
        <input type="password" id="password" name="password" required minlength="6"><br><br>

        <button type="submit">Registreren</button>
    </form>

    <p>Al een account? <a href="login.php">Log hier in</a>.</p>
</body>

</html>