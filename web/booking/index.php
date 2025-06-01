<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking</title>
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<script src="/js/BookingItem.js"></script>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <div class="item-grid">
        <booking-item id="1" price="12,34" loc="Griekenland" name="Athene"></booking-item>
        <booking-item id="2" price="12,34" loc="Rusland" name="Moscow"></booking-item>
        <booking-item id="3" price="12,34" loc="Nigeria" name="Abuja"></booking-item>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>