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

// Query voorbereiden
$stmt = $pdo->prepare("SELECT * FROM products");
// Query uitvoeren
$stmt->execute();
// Resultaten ophalen
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($products as $product) {
echo "<div class='product'>";
echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
echo "<p>Prijs: €" . htmlspecialchars($product['price']) . "</p>";
// Voeg eventueel meer productdetails toe
echo "</div>";
}
$stmt = $pdo->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>