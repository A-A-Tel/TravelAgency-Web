<?php session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session()) {
    $db->alert_and_send("Not permitted.", "/travel/");
    exit;
}

$travel_id = $_POST['travel_id'];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE travel_id = :travel_id");
$stmt->execute(["travel_id" => $travel_id]);
$booking =  $stmt->fetch();

if ($booking) {
    $db->alert_and_send("Already booked this travel.", "/travel/");
}