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

$name = $_POST["name"];
$price = $_POST["price"];
$description = $_POST["description"];
$location_id = $_POST["location"];
$image = $_FILES["image"];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("SELECT * FROM travels WHERE name = :name");
$stmt->execute(['name' => $name]);
$travel = $stmt->fetch();

echo $price;

if ($travel)
{
    $db->alert_and_send("Travel already exists", "/admin/travel/");
    exit;
}

if
(
    !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,32}$/u", $name) ||
    !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,140}$/u", $description) ||
    !preg_match("/^(?=.{1,10}$)[0-9]+(\.[0-9]{1,2})?$/", $price) ||
    !preg_match("/^[0-9]+$/", $location_id) ||
    $image["error"] != 0
)
{
    $db->alert_and_send("Invalid input", "/admin/travel/");
}

$stmt = $pdo->prepare("INSERT INTO travels (name, price, description, location_id) VALUES (:name, :price, :description, :location_id)");
$stmt->execute(["name" => $name, "price" => $price, "description" => $description, "location_id" => intval($location_id)]);

$stmt = $pdo->prepare("SELECT * FROM travels WHERE name = :name");
$stmt->execute(["name" => $name]);
$image["name"] = $stmt->fetch()["travel_id"];

move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/travel-items/" . basename($image["name"]));

$db->alert_and_send("Successfully added travel", "/admin/travel");