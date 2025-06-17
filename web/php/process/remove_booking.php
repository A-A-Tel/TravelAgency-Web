<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/");
    exit;
}

$pdo = $db->get_pdo();
$booking_id = $_POST["booking_id"];

if (!$db->is_admin_session())
{
    $stmt = $pdo->prepare("SELECT users.user_id FROM bookings INNER JOIN users ON bookings.user_id = users.user_id WHERE bookings.booking_id =:booking_id");
    $stmt->execute(["booking_id" => $booking_id]);
    $user_id = $stmt->fetch()['user_id'];

    if ($user_id !== $_SESSION["id"])
    {
        $db->alert_and_send("Not permitted", "/account/");
        exit;
    }
}

$stmt = $pdo->prepare("DELETE FROM bookings WHERE booking_id=:booking_id");
$stmt->execute(["booking_id" => $booking_id]);

$db->alert_and_send("Successfully removed booking", "/admin/accounts/");