<?php
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

session_start();
session_unset();
session_destroy();

$db->alertAndSend("Successfully logged out", "/");