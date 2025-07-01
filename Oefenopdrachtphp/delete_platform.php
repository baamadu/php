<?php
session_start();
include 'db.php';

$id = $_GET['id'];
$connection->query("DELETE FROM platforms WHERE id=$id");

$_SESSION['message'] = "Platform verwijderd";
header("Location: index.php");
exit;
