<?php
include 'db.php';

$platform_id = $_GET['id'];

$platform = $connection->query("SELECT * FROM platforms WHERE id = $platform_id")->fetch_assoc();
$games = $connection->query("SELECT * FROM games WHERE platform_id = $platform_id");

$total_number_of_games = 0;
$total_price = 0.00;
?>

<h1>Details van Platform</h1>
<p><strong>Naam:</strong> <?= htmlspecialchars($platform['name']) ?></p>
<p><strong>Fabrikant:</strong> <?= htmlspecialchars($platform['manufacturer']) ?></p>

<h2>Games op dit Platform</h2>

<?php if ($games->num_rows > 0): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Titel</th>
            <th>Genre</th>
            <th>Prijs (€)</th>
        </tr>
        <?php while ($game = $games->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($game['title']) ?></td>
                <td><?= htmlspecialchars($game['genre']) ?></td>
                <td><?= number_format($game['price'], 2, ',', '.') ?></td>
            </tr>
            <?php
                $total_number_of_games++;
                $total_price += $game['price'];
            ?>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>Er zijn geen games voor dit platform.</p>
<?php endif; ?>

<p><strong>Totaal aantal games:</strong> <?= $total_number_of_games ?></p>
<p><strong>Totaal prijs van alle games:</strong> € <?= number_format($total_price, 2, ',', '.') ?></p>

<a href="index.php">← Terug naar overzicht</a>
