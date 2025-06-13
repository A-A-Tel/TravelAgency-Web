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

$pdo = new db()->pdo;

$name = $_POST["name"];
$image = $_FILES["image"];

$stmt = $pdo->prepare("SELECT * FROM locations WHERE name = :name");
$stmt->execute(['name' => $name]);
$location = $stmt->fetch();

if ($location)
{
    $db->alertAndSend("Location already exists", "/admin/travel");
    exit;
}

if
(
    !preg_match("/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]{1,32}$/u", $name) ||
    $image["error"] != 0
)
{
    $db->alertAndSend("Invalid input", "/admin/travel");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO locations (name) VALUES (:name)");
$stmt->execute(array(":name" => $name));

$stmt = $pdo->prepare("SELECT * FROM locations WHERE name = :name");
$stmt->execute(array(":name" => $name));
$location = $stmt->fetch();
$image["name"] = $location["location_id"];

move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/location-items/" . basename($image["name"]));

$db->alertAndSend("Successfully added location", "/admin/travel");

