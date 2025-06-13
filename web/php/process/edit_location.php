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

$location_id = $_POST["location_id"];
$name = $_POST["name"];

if (!preg_match("/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]{1,32}$/u", $name))
{
    $db->alert_and_send("Invalid input", "/admin/travel");
    exit;
}

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("UPDATE locations SET name = :name WHERE location_id = :location_id");
$stmt->execute(["name" => $name, "location_id" => $location_id]);

if (isset($_FILES["image"]))
{
    $image = $_FILES["image"];
    $image['name'] = $location_id;

    move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/location-items/" . basename($image['name']));
}
$db->alert_and_send("Successfully edited location", "/admin/travel/");