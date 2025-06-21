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
// Controleer of er een ID is meegegeven
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Stuur terug naar productenpagina als er geen ID is
    header("Location: products.php");
    exit;
}
$productId = $_GET['id'];
// Haal de productgegevens op
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);
// Controleer of het product bestaat
if (!$product) {
    // Product niet gevonden
    header("Location: products.php");
    exit;
}
// Als het formulier is verzonden, verwerk de update (invullen in volgende stap)
?>

<form method="POST" action="update_product.php">
<input type="hidden" name="id" value="<?= $product['id'] ?>">
<div>
<label for="name">Naam:</label>
<input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" required>
</div>
<div>
<label for="price">Prijs:</label>
<input type="number" name="price" id="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
</div>
<div>
<label for="description">Beschrijving:</label>
<textarea name="description" id="description"><?= htmlspecialchars($product['description']) ?></textarea>
</div>
<button type="submit">Product bijwerken</button>
</form>