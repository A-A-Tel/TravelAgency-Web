<?php
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

unset($_SESSION['orders']);
$db->alert_and_send("Successfully cleared orders", "/");