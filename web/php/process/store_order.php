<?php
session_start();
require getenv("WEB_ROOT") . "php/classes/db.php";

use classes\order;
use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/travel/");
    exit;
}

$travel_id = $_POST['id'];
$start = $_POST['start'];
$end = $_POST['end'];

$startDate = DateTime::createFromFormat('Y-m-d', $start);
$endDate = DateTime::createFromFormat('Y-m-d', $end);

if (
    !preg_match('/^[0-1]+$/', $travel_id) ||
    !$startDate || !$endDate || // check if parsing failed
    $startDate >= $endDate
)
{
    $db->alert_and_send("Not permitted", "/travel/");
    exit;
}

$order = new order($travel_id, $start, $end);

if (!isset($_SESSION['orders'])) $_SESSION['orders'] = [];
$_SESSION['orders'][] = $order;

$db->alert_and_send("Successfully added to orders", "/travel/");

