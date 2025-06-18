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

$contact_id = $_POST["contact_id"];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("UPDATE contact SET answered=true WHERE contact_id = :contact_id");
$stmt->execute(["contact_id" => $contact_id]);

$db->alert_and_send("Successfully answered contact", "/admin/contact/");

