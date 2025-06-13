<?php
session_start();
require_once "../classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    $db->alertAndSend("Not permitted", "/login/");
}

$email = $_POST["email"];
$pass = $_POST["pass"];

$pdo = new db()->pdo;
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

if (!$user || !password_verify($pass, $user["pass"]))
{
    $db->alertAndSend("Invalid input", "/login/");
    exit;
}

$_SESSION["valid"] = true;
$_SESSION["id"] = $user["user_id"];
$_SESSION["name"] = $user["name"];
$_SESSION["email"] = $user["email"];
$_SESSION["admin"] = $user["is_admin"];

$db->alertAndSend('Successfully logged in', "/account/");