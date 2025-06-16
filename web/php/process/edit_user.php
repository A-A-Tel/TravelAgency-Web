<?php
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];
$avatar = $_FILES['avatar'];