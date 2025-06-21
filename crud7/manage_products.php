<?php


// Databaseverbinding instellen
$host = 'localhost';
$db = 'webshops';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Producten ophalen
    $stmt = $pdo->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Verbindingsfout: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Productbeheer</title>
    
</head>
<body>
<table>
<tr>
<th>Naam</th>
<th>Prijs</th>
<th>Acties</th>
</tr>
<?php foreach ($products as $product): ?>
<tr>
<td><?= htmlspecialchars($product['name']) ?></td>
<td>€<?= htmlspecialchars($product['price']) ?></td>
<td>
<a href="edit_product.php?id=<?= $product['id'] ?>">Bewerken</a>
<a href="delete_product.php?id=<?= $product['id'] ?>">Verwijderen</a>
</td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>




