<?php
require_once getenv("WEB_ROOT") . "php/classes/order.php";
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/");
    exit;
}

if (!isset($_SESSION['orders']) || count($_SESSION['orders']) <= 0)
{
    $db->alert_and_send("No orders", "/travel/");
    exit;
}

$pdo = $db->get_pdo();
$orders = $_SESSION['orders'];
$user_id = $_SESSION['id'];

for ($i = 0; $i < count($orders); $i++)
{
    $order = $_SESSION['orders'][$i];

    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, travel_id, begin_date, end_date) VALUES (:user_id, :travel_id, :start, :end)");
    $stmt->execute(["user_id" => $user_id, "travel_id" => $order->get_travel_id(), "start" => $order->get_start(), "end" => $order->get_end()]);
}

include getenv("WEB_ROOT") . "php/process/clear_order.php";

$db->alert_and_send("Successfully booked all travels", "/account/");