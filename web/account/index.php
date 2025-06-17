<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session()) {
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$pdo = $db->get_pdo();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main class="column flex-center margin-vertical">
    <div class="row item-preview">
        <img src="/img/user-items/<?php echo $_SESSION["id"] ?>" alt="item">
        <div>
            <p>
                Naam: <?php echo $_SESSION["name"]; ?>
                <br>
                Email: <?php echo $_SESSION["email"]; ?>
                <br>
                Wachtwoord: ********
            </p>
            <div>
                <button onclick="deleteAccount('<?php echo $_SESSION['id'] ?>')" style="background: #F00">Verwijder</button>
                <button onclick="editAccount('<?php echo $_SESSION['id'] ?>')" style="background: #FF8800">Bewerk</button>
            </div>
        </div>
    </div>

    <div class="item-grid grid-wrap">

        <?php

        $template = '
        <div class="item-info">
        <img src="/img/travel-items/%s" alt="image">
            <p>
                Naam: %s
                <br>
                Locatie: %s
                <br>
                Prijs: &euro;%s
                <br>
                Datum: %s - %s
                <br>
                Goedgekeurd: %s 
            </p>
            <span>
                <button onclick="removeBooking(`%s`)" style="background: #e12a37;">Annuleren</button>
            </span>
        </div>
        ';

        $stmt = $pdo->prepare("SELECT bookings.*, travels.*, locations.name AS location_name FROM bookings INNER JOIN travels ON bookings.travel_id = travels.travel_id INNER JOIN locations ON travels.location_id = locations.location_id WHERE bookings.user_id = :user_id");
        $stmt->execute(['user_id' => $_SESSION['id']]);
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking)
        {
            echo sprintf($template, $booking['travel_id'], $booking['name'], $booking['location_name'], $booking['price'], $booking['begin_date'], $booking['end_date'], $booking['approved'] ? "Ja" : "Nee", $booking['booking_id']);
        }

        ?>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>