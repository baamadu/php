<?php


try {
    // De connectie-gegevens (aanpassen naar jouw situatie)
    $host = 'localhost';
    $dbname = 'webshops';
    $username = 'root';
    $password = '';
    // Maak de verbinding
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Stel de error mode in
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Verbinding geslaagd!";
} catch (PDOException $e) {
    echo "Verbindingsfout: " . $e->getMessage();
}


// Controleer of er een ID is
$productId = $_GET['id'] ?? '';
if (empty($productId)) {
header("Location: products.php");
exit;
}
// Als het een POST verzoek is, voer de verwijdering uit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
try {
$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$productId]);
header("Location: products.php?message=Product verwijderd");
exit;
} catch (PDOException $e) {
// Toon foutmelding
echo "Er is een fout opgetreden: " . $e->getMessage();
}
} else {
// Haal productnaam op voor bevestiging
$stmt = $pdo->prepare("SELECT name FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$product) {
header("Location: products.php");
exit;
}
}
?>

<h2>Product verwijderen</h2>
<p>Weet je zeker dat je het product "<?= htmlspecialchars($product['name']) ?>" wilt verwijderen?</p>
<form method="POST">
<button type="submit">Ja, verwijder product</button>
<a href="products.php">Annuleren</a>
</form>
