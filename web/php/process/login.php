<?php
session_start();
require_once "../classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    $db->alert_and_send("Not permitted", "/login/");
}

$email = $_POST["email"];
$pass = $_POST["pass"];

$pdo = new db()->pdo;
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

if (!$user || !password_verify($pass, $user["pass"]))
{
    $db->alert_and_send("Invalid input", "/login/");
    exit;
}

$_SESSION["valid"] = true;
$_SESSION["id"] = $user["user_id"];
$_SESSION["name"] = $user["name"];
$_SESSION["email"] = $user["email"];
$_SESSION["is_admin"] = $user["is_admin"];

$db->alert_and_send('Successfully logged in', "/account/");