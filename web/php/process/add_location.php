<?php

require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

session_start();

if (!isset($_SESSION['valid']) || !$_SESSION['valid'] || !$_SESSION['admin'])
{
    header("Location: /login/");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $pdo = new db()->pdo;

    $name = $_POST["name"];
    $image = $_FILES["image"];

    $stmt = $pdo->prepare("SELECT * FROM locations WHERE name = :name");
    $stmt->execute(['name' => $name]);
    $location = $stmt->fetch();

    if ($location)
    {
        $alert_message = "Location already exists!";
    }
    else if
    (
        !preg_match("/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]{1,32}$/u", $name) ||
        $image["error"] != 0
    )
    {
        $alert_message = "Invalid input";
    }
    else
    {
        $stmt = $pdo->prepare("INSERT INTO locations (name) VALUES (:name)");
        $stmt->execute(array(":name" => $name));

        $stmt = $pdo->prepare("SELECT * FROM locations WHERE name = :name");
        $stmt->execute(array(":name" => $name));
        $location = $stmt->fetch();
        $image["name"] = $location["id"];


        move_uploaded_file($image["tmp_name"], getenv("WEB_ROOT") . "img/location-items/" . basename($image["name"]));

        $alert_message = "Location added";
    }
}
else
{
    header("Location: /login/");
    exit;
}
echo "<script type='text/javascript'>alert('$alert_message'); window.location.href='/admin/travel/'</script>";