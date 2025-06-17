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

$booking_id = $_POST["booking_id"];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("UPDATE bookings SET approved=:approved WHERE booking_id=:booking_id");
$stmt->execute(["booking_id" => $booking_id, "approved" => true]);

$db->alert_and_send("Successfully approved booking", "/admin/booking/");