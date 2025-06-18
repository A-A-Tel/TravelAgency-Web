<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !$db->is_admin_session())
{
    $db->alert_and_send("Not permitted", "/account/");
    exit;
}

$travel_id = $_POST["travel_id"];
$name = $_POST["name"];
$location_id = $_POST["location"];
$description = $_POST["description"];
$price = $_POST["price"];

if
(
    !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,32}$/u", $name) ||
    !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,140}$/u", $description) ||
    !preg_match("/^(?=.{1,10}$)[0-9]+(\.[0-9]{1,2})?$/", $price) ||
    !preg_match("/^[0-9]+$/", $location_id)
)
{
    $db->alert_and_send("Invalid input", "/admin/travel/");
    exit;
}

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("UPDATE travels SET name=:name, description=:description, price=:price, location_id=:location_id WHERE travel_id = :travel_id");
$stmt->execute(["name" => $name, "description" => $description, "price" => $price, "location_id" => $location_id, "travel_id" => $travel_id]);

if (isset($_FILES["image"]))
{
    $image = $_FILES["image"];
    $image['name'] = $travel_id;

    move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/travel-items/" . basename($image['name']));
}
$db->alert_and_send("Successfully edited travel", "/admin/travel/");