<?php
session_start();
require getenv("WEB_ROOT") . "php/classes/db.php";
require getenv("WEB_ROOT") . "php/classes/order.php";

use classes\db;
use classes\order;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/travel/");
    exit;
}

$travel_id = $_POST['travel_id'];
$start = $_POST['start'];
$end = $_POST['end'];

$startDate = DateTime::createFromFormat('Y-m-d', $start);
$endDate = DateTime::createFromFormat('Y-m-d', $end);

if
(
    !preg_match('/^[0-9]+$/', $travel_id) ||
    !$startDate ||
    !$endDate ||
    $startDate >= $endDate
)
{
    $db->alert_and_send("Invalid input", "/travel/");
    exit;
}

$order = new order($travel_id, $start, $end);

if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];
$_SESSION['orders'][] = $order;

$db->alert_and_send("Successfully added to orders", "/travel/");

