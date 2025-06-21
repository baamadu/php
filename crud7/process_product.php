<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // De connectie-gegevens (aanpassen naar jouw situatie)
        $host = 'localhost';
        $dbname = 'webshopS';
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
    // Gegevens ophalen uit het formulier
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    // Hier komt de INSERT query
    try {
        // INSERT query voorbereiden
        $stmt = $pdo->prepare("INSERT INTO products (name, price, description)
VALUES (:name, :price, :description)");
        // Parameters binden
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        // Query uitvoeren
        $stmt->execute();
        // Het ID van het toegevoegde product ophalen
        $productId = $pdo->lastInsertId();
        // Redirect naar een bevestigingspagina
        header("Location: confirmation.php?id=" . $productId);
        exit;
    } catch (PDOException $e) {
        echo "Fout bij toevoegen: " . $e->getMessage();
    }
    // ...
}


?>