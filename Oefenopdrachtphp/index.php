<?php
include 'db.php';
session_start();

$result = $connection->query("SELECT * FROM platforms");
?>

<div class="row">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <?php $_SESSION['message'] = null; ?>
        </div>
    <?php endif; ?>
</div>

<h1>Platforms</h1>
<a href="add_platform.php">Nieuw platform toevoegen</a>
<table border="1">
    <tr><th>Naam</th><th>Fabrikant</th><th>Acties</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['manufacturer']) ?></td>
            <td>
                <a href="detail.php?id=<?= $row['id'] ?>">Details</a> |
                <a href="edit_platform.php?id=<?= $row['id'] ?>">Bewerk</a> |
                <a href="delete_platform.php?id=<?= $row['id'] ?>" onclick="return confirm('Weet je het zeker?')">Verwijder</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
