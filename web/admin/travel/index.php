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

$pdo = $db->pdo;
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
            <img src="/img/placeholder.svg" alt="placeholder">
            <p>
                Voeg een nieuwe reis toe!
            </p>
            <a href="/admin/add-travel" style="background: #1aa377;" >Toevoegen</a>
        </div>

        <?php

        $template = '
        <div class="item-info">
        <img src="/img/travel-items/%s" alt="image">
            <p>
                Naam: %s
                <br>
                Locatie: %s
                <br>
                Prijs: %s
                <br>
                Beschrijving: %s
            </p>
            <span>
                <button onclick="adminRemoveTravel(`%s`)" style="background: #e12a37;">Verwijder</button>
                <button style="background: #ff8700;">Bewerk</button>
            </span>
        </div>
        ';
        $rows = $pdo->query("SELECT * FROM travels")->fetchAll();

        foreach ($rows as $row)
        {
            $stmt = $pdo->prepare("SELECT * FROM locations WHERE location_id=:id");
            $stmt->execute(['id' => $row['location_id']]);
            $location_name = $stmt->fetch()['name'];
            echo sprintf($template, $row['travel_id'], $row['name'], $location_name, $row['price'], $row["description"], $row['travel_id']);
        }

        ?>
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
            <span class='location-span'>
                <span>%s</span>
                <button onclick='adminRemoveLocation(`%s`)' class='location-remove-button' style='background: #e12a37;'>Verwijderen</button>
            </span>
        </div>
        ";

        $rows = $pdo->query("SELECT * FROM locations");

        foreach ($rows as $row)
        {
            echo sprintf($template, $row['location_id'], $row['name'], $row["location_id"]);
        }

        ?>

    </div>
</main>

<?php
include getenv('WEB_ROOT') . "php/templates/footer.php";
?>
</body>
</html>