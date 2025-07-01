<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$result = $connection->query("SELECT * FROM platforms WHERE id=$id");
$platform = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $manufacturer = $_POST['manufacturer'];
    $stmt = $connection->prepare("UPDATE platforms SET name=?, manufacturer=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $manufacturer, $id);
    $stmt->execute();

    $_SESSION['message'] = "Platform bijgewerkt";
    header("Location: index.php");
    exit;
}
?>

<h2>Platform Bewerken</h2>
<form method="post">
    Naam: <input type="text" name="name" value="<?= htmlspecialchars($platform['name']) ?>" required><br>
    Fabrikant: <input type="text" name="manufacturer" value="<?= htmlspecialchars($platform['manufacturer']) ?>" required><br>
    <input type="submit" value="Opslaan">
</form>

