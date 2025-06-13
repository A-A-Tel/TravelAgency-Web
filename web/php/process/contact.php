<?php
require_once "../classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    $db->alert_and_send("Not permitted", "/contact/");
    exit;
}

$pdo = $db->get_pdo();

$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

if
(
    !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]{2,64}$/u", $name) ||
    !preg_match("/^(?=.{1,320}$)[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) ||
    !preg_match('/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]+$/u', $message)
)
{
    $db->alert_and_send("Invalid input", "/contact/");
}


$stmt = $pdo->prepare("INSERT INTO contact (name, email, message) VALUES(:name, :email, :message)");
$stmt->execute(["name" => $name, "email" => $email, "message" => $message]);

$db->alert_and_send("Successfully sent contact request", "/contact/");