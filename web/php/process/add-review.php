<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_SESSION["valid"]) || !$_SESSION["valid"])
{
    echo "<script type='text/javascript'>alert('Not permitted'); window.location.href='/account/'</script>";
    exit;
}

require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$pdo = new db()->pdo;

$travel_id = $_POST["travel_id"];
$user_id = $_SESSION["id"];
$score = $_POST["score"];
$content = $_POST["content"];

if
(
    !preg_match("/^[0-9]+$/", $travel_id) ||
    !preg_match("/^[0-9]+$/", $user_id) ||
    !preg_match("/^[1-5]$/", $score) ||
    !preg_match('/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]{1,120}$/u', $content)
)
{
    echo "<script type='text/javascript'>alert('Invalid input'); window.location.href='/account/'</script>";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO reviews (travel_id, user_id, score, content) VALUES (:travel_id, :user_id,  :score, :content)");
$stmt->execute(["travel_id" => $travel_id, "user_id" => $user_id, "score" => $score, "content" => $content]);

echo "<script type='text/javascript'>alert('Review added'); window.location.href='/account/'</script>";