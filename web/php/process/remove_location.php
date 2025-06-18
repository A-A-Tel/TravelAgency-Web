<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$db->is_admin_session())
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$pdo = $db->get_pdo();

$location_id = $_POST['location_id'];

$stmt = $pdo->prepare("SELECT travel_id FROM travels WHERE location_id = :location_id");
$stmt->execute(["location_id" => $location_id]);
$rows = $stmt->fetchAll();

foreach ($rows as $row)
{
    $stmt = $pdo->prepare("DELETE FROM reviews WHERE travel_id = :travel_id");
    $stmt->execute(["travel_id" => $row["travel_id"]]);

    $stmt = $pdo->prepare("DELETE FROM bookings WHERE travel_id = :travel_id");
    $stmt->execute(["travel_id" => $row["travel_id"]]);

    $stmt = $pdo->prepare("DELETE FROM travels WHERE travel_id = :travel_id");
    $stmt->execute(["travel_id" => $row["travel_id"]]);
}

$stmt = $pdo->prepare("DELETE FROM locations WHERE location_id = :location_id");
$stmt->execute(["location_id" => $location_id]);

$db->alert_and_send("Successfully removed location", "/admin/travel/");