<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Bookings</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv('WEB_ROOT') . "php/templates/header.php";
?>

<main>
    <div class="item-grid grid-wrap">
        <div class="item-info">
            <p>
                Naam: Lorem
                <br>
                Locatie: Ipsum
                <br>
                Prijs: €Dolor,sit
                <br>
                Beschrijving: amet...
            </p>
            <span>
                <button style="background: #e12a37;">Verwijder</button>
                <button style="background: #ff8700;">Bewerk</button>
            </span>
        </div>
        <div class="item-info">
            <p>
                Naam: Lorem
                <br>
                Locatie: Ipsum
                <br>
                Prijs: €Dolor,sit
                <br>
                Beschrijving: amet...
            </p>
            <span>
                <button style="background: #e12a37;">Verwijder</button>
                <button style="background: #ff8700;">Bewerk</button>
            </span>
        </div>
    </div>
</main>

<?php
include getenv('WEB_ROOT') . "php/templates/footer.php";
?>
</body>
</html>