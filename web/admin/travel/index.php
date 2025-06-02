<?php

require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

session_start();

if (!isset($_SESSION['valid']) || !$_SESSION['valid'] || !$_SESSION['admin'])
{
    header("Location: /login/");
    exit;
}
$pdo = new db()->getPdo();

?>

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
    </div>

    <div class="item-grid">

        <div class="item">
            <div></div>
        <a href="/admin/add-location/">Nieuwe locatie</a>
        </div>


        <?php

        $template = "
        
        <div class=\"item\">
            <div style=\"background: #000 url('/img/location-items/%s') no-repeat center / 100%% 100%%\"></div>
            <span>%s</span>
        </div>
        ";

        $rows = $pdo->query("SELECT * FROM locations");

        foreach ($rows as $row)
        {
            echo sprintf($template, $row['id'], $row['name']);
        }

        ?>

    </div>
</main>

<?php
include getenv('WEB_ROOT') . "php/templates/footer.php";
?>
</body>
</html>