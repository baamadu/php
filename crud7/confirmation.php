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
} catch(PDOException $e) {
echo "Verbindingsfout: " . $e->getMessage();
}

if (isset($_GET['id'])) {
$productId = $_GET['id'];
// Product ophalen met het gegeven ID
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->bindParam(':id', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);
// Nu product gegevens tonen als bevestiging

if ($product) {
echo "<div class='confirmation'>";
echo "<h2>Product succesvol toegevoegd!</h2>";
echo "<p><strong>Naam:</strong> " . htmlspecialchars($product['name']) . "</p>";
echo "<p><strong>Prijs:</strong> €" . htmlspecialchars($product['price']) . "</p>";
echo "<p><strong>Beschrijving:</strong> " . htmlspecialchars($product['description']) . "</p>";
// Eventueel meer productdetails tonen
echo "</div>";
echo "<p><a href='products.php'>Terug naar producten</a></p>";
} else {
echo "<p>Product niet gevonden.</p>";
}
}


?>