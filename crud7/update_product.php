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
// Controleer of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valideer en verzamel de gegevens
    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $description = $_POST['description'] ?? '';
    // Voer basis validatie uit
    if (empty($id) || empty($name) || empty($price)) {
        // Toon foutmelding en/of redirect
        echo "Alle velden moeten ingevuld zijn";
        exit;
    }
    try {
        // UPDATE query via PDO
        $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
        $stmt->execute([$name, $price, $description, $id]);
        // Redirect na succesvolle update
        header("Location: products.php?message=Product bijgewerkt");
        exit;
    } catch (PDOException $e) {
        // Toon foutmelding (in productie: log error, toon gebruikersvriendelijke melding)
        echo "Database error: " . $e->getMessage();
    }
}
?>