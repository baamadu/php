<!-- navbar.php -->
<nav style="background-color: #f4f4f4; padding: 10px;">
    <a href="products.php" style="margin-right: 15px;">Producten</a>
    <a href="add_product.php" style="margin-right: 15px;">Nieuw product toevoegen</a>
</nav>
<hr>



<form method="post" action="process_product.php">
<div>
<label for="name">Productnaam:</label>
<input type="text" id="name" name="name" required>
</div>
<div>
<label for="price">Prijs:</label>
<input type="number" id="price" name="price" step="0.01" required>
</div>
<div>
<label for="description">Beschrijving:</label>
<textarea id="description" name="description"></textarea>
</div>
<!-- Voeg eventueel meer velden toe zoals categorie, voorraad, etc. -->
<button type="submit">Product toevoegen</button>
</form>
