<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_admin_session())
{
    $db->alert_and_send("Not permitted", "/account/");
    exit;
}

$pdo = $db->get_pdo();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookings</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <div class="item-grid grid-wrap">

        <?php

        $template = '
            <div class="item-info">
                <p>
                    Naam: %s
                    <br>
                    Datum: %s - %s
                    <br>
                    Reis: %s
                    <br>
                    Goedgekeurd: %s
                </p>
                <span>
                    <button onclick="removeBooking(`%s`)" style="background: #e12a37;">Verwijder</button>
                    <button onclick="approveBooking(`%s`)" style="background: #27d39b;">Keur goed</button>
                </span>
            </div>
        ';

        $rows = $pdo->query("SELECT bookings.*, travels.name AS travel_name, users.name AS user_name FROM bookings INNER JOIN travels ON bookings.travel_id = travels.travel_id INNER JOIN users ON bookings.user_id = users.user_id");

        foreach ($rows as $row)
        {
            echo sprintf($template, $row['user_name'], $row['begin_date'], $row['end_date'], $row['travel_name'], $row['approved'] ? "Ja" : "Nee", $row['booking_id'], $row['booking_id']);
        }
        ?>


    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>