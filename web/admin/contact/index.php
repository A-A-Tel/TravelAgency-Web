<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Booking</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv('WEB_ROOT') . "/php/templates/header.php";

?>
<main>
    <div class="item-grid grid-wrap">
        <div class="booking-info">
            <p>
                Datum/Tijd: xx-xx-xxxx/xx:xx
                <br>
                Naam: Lorem
                <br>
                Email: ipsum@dolor.sit
                <br>
                Bericht:
                <br>
                amet consectetur adipiscing elit
            </p>
            <button>Verwijder</button>
        </div>
        <div class="booking-info">
            <p>
                Datum/Tijd: xx-xx-xxxx/xx:xx
                <br>
                Naam: Lorem
                <br>
                Email: ipsum@dolor.sit
                <br>
                Bericht:
                <br>
                amet consectetur adipiscing elit
            </p>
            <button>Verwijder</button>
        </div>
        <div class="booking-info">
            <p>
                Datum/Tijd: xx-xx-xxxx/xx:xx
                <br>
                Naam: Lorem
                <br>
                Email: ipsum@dolor.sit
                <br>
                Bericht:
                <br>
                amet consectetur adipiscing elit
            </p>
            <button>Verwijder</button>
        </div>
    </div>
</main>
<?php
include getenv('WEB_ROOT') . "/php/templates/footer.php";
?>
</body>
</html>