<?php

try {

    $db = new PDO(
        "mysql:host=localhost;dbname=news",
        "root",
        ""
    );
} catch (PDOException $exception) {
    die('Error! ' . $exception->getMessage());
}
