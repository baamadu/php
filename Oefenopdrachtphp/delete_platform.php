<?php
include 'db.php';
$id = $_GET['id'];
$connection->query("DELETE FROM platforms WHERE id=$id");
header("Location: index.php?msg=Platform verwijderd");
exit;
