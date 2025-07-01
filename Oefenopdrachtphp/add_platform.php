<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $manufacturer = $_POST['manufacturer'];
    $stmt = $connection->prepare("INSERT INTO platforms (name, manufacturer) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $manufacturer);
    $stmt->execute();

    $_SESSION['message'] = "Platform toegevoegd";
    header("Location: index.php");
    exit;
}
?>

<h2>Nieuw Platform</h2>
<form method="post">
    Naam: <input type="text" name="name" required><br>
    Fabrikant: <input type="text" name="manufacturer" required><br>
    <input type="submit" value="Toevoegen">
</form>

