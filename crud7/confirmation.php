


<?php
// Databaseverbinding
try {

    // De connectie-gegevens (aanpassen naar jouw situatie)
    $host = 'localhost';
    $dbname = 'webshops';
    $username = 'root';
    $password = '';
    
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Verbindingsfout: " . $e->getMessage();
    exit;
}

// Controleren of er een ID in de URL staat
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Product met dit ID ophalen
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->bindParam(':id', $productId);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Geen product ID opgegeven.";
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product toegevoegd</title>
</head>

<body>

    <!-- Navigatiebalk direct in dit bestand -->
  <nav style="background-color: #f4f4f4; padding: 10px;">
    <a href="products.php" style="margin-right: 15px;">Producten</a>
    <a href="add_product.php" style="margin-right: 15px;">Nieuw product toevoegen</a>
    <a href="manage_products.php" style="margin-right: 15px;">Producten toevoegen</a>
</nav>
<hr>

    <h2>Product succesvol toegevoegd!</h2>

    <?php if ($product): ?>
        <p><strong>Naam:</strong> <?= htmlspecialchars($product['name']) ?></p>
        <p><strong>Prijs:</strong> €<?= htmlspecialchars($product['price']) ?></p>
        <p><strong>Beschrijving:</strong> <?= nl2br(htmlspecialchars($product['description'])) ?></p>
    <?php else: ?>
        <p>Product niet gevonden.</p>
    <?php endif; ?>

    <p><a href="products.php">Terug naar productenlijst</a></p>

</body>

</html>