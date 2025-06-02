<?php
session_start();

require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

if (!isset($_SESSION['valid']) || !$_SESSION['valid'] || !$_SESSION['admin'])
{
    header("Location: /login/");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $location_id = $_POST["location"];
    $image = $_FILES["image"];

    $pdo = new db()->pdo;
    $stmt = $pdo->prepare("SELECT * FROM travels WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $travel = $stmt->fetch();

    echo $price;

    if ($travel)
    {
        $alert_message = "Travel already exists.";
    }
    else if
    (
        !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,32}$/u", $name) ||
        !preg_match("/^([\p{L}\p{N}\p{P}\p{S}\p{Z}]){1,140}$/u", $description) ||
        !preg_match("/^(?=.{1,10}$)[0-9]+(\.[0-9]{1,2})?$/", $price) ||
        !preg_match("/^[0-9]+$/", $location_id) ||
        $image["error"] != 0
    )
    {
        $alert_message = "Invalid input";
    }
    else
    {
        $stmt = $pdo->prepare("INSERT INTO travels (name, price, description, location_id) VALUES (:name, :price, :description, :location_id)");
        $stmt->execute(["name" => $name, "price" => $price, "description" => $description, "location_id" => intval($location_id)]);

        $stmt = $pdo->prepare("SELECT * FROM travels WHERE name = :name");
        $stmt->execute(["name" => $name]);
        $image["name"] = $stmt->fetch()["id"];

        move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/travel-items/" . basename($image["name"]));

        $alert_message = "Travel added successfully.";
    }
}
else
{
    header("Location: /login/");
    exit;
}
echo("<script>alert('$alert_message'); window.location.href = '/admin/travel/';</script>");