<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$pdo = $db->get_pdo();
$user_id = $db->is_user_session() ? $_POST['user_id'] : $_SESSION['user_id'];

$stmt = $pdo->prepare("DELETE FROM reviews WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);

$stmt = $pdo->prepare("DELETE FROM bookings WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);

$stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);


if ($db->is_user_session())
{
    require_once getenv("WEB_ROOT") . "php/process/logout.php";
}

header("");

$href = $_SESSION['is_admin'] ? 'admin/accounts' : 'register';
$db->alert_and_send("Successfully deleted user", "/$href/");
