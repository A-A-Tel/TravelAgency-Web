<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$db->is_admin_session())
{
    $db->alertAndSend("Not permitted", "/account/");
    exit;
}

$travel_id = $_POST['travel_id'];

$pdo = $db->pdo;

$stmt = $pdo->prepare("DELETE FROM reviews WHERE travel_id = :travel_id");
$stmt->execute(["travel_id" => $travel_id]);

$stmt = $pdo->prepare("DELETE FROM bookings WHERE travel_id = :travel_id");
$stmt->execute(["travel_id" => $travel_id]);

$stmt = $pdo->prepare("DELETE FROM travels WHERE travel_id = :travel_id");
$stmt->execute(["travel_id" => $travel_id]);

$db->alertAndSend("Successfully removed travel", "/admin/travel/");