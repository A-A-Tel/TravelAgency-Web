<?php
require_once getenv("WEB_ROOT") . "php/classes/order.php";
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/");
    exit;
}
$pdo = $db->get_pdo();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php include getenv("WEB_ROOT") . "php/templates/header.php" ?>

<main class="column align-center">
    <h1 class="title">Uw bestelling</h1>
    <form action="/php/process/add_booking.php" method="POST">

        <?php

        $template = "
                <div class='form-item'>
                    <h2>Naam: %s<br>Prijs: &euro;%s<br>Begindatum: %s<br>Einddatum: %s</h2>
                </div>
        ";

        if (isset($_SESSION["orders"]) && count($_SESSION["orders"]) > 0)
        {
            $orders = $_SESSION["orders"];
            for ($i = 0; $i < count($orders); $i++)
            {
                $order = $orders[$i];

                $stmt = $pdo->prepare("SELECT travels.name, travels.price FROM travels WHERE travel_id=:travel_id");
                $stmt->execute([":travel_id" => $order->get_travel_id()]);
                $travel = $stmt->fetch();

                echo sprintf($template, $travel['name'], $travel['price'], $order->get_start(), $order->get_end());
            }
        }

        ?>

        <input type="submit" value="Bestellen..." class="submit">
    </form>
</main>

<?php include getenv("WEB_ROOT") . "php/templates/footer.php" ?>
</body>
</html>
