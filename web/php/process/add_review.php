<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/account/");
    exit;
}

$pdo = $db->get_pdo();

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
    $db->alert_and_send("Invalid input", "/account/");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO reviews (travel_id, user_id, score, content) VALUES (:travel_id, :user_id,  :score, :content)");
$stmt->execute(["travel_id" => $travel_id, "user_id" => $user_id, "score" => $score, "content" => $content]);

$db->alert_and_send("Successfully added review", "/account/");