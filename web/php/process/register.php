<?php

use process\db;

$alert_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = new db()->getPdo();
    $rows = $pdo->query("SELECT * FROM users");
} else {
    header("Location /login/");
    exit;
}

header("Location /");
echo "<script type='text/javascript'>alert('$alert_message');</script>";
