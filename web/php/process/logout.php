<?php
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

session_start();
session_unset();
session_destroy();

$db->alert_and_send("Successfully logged out", "/");