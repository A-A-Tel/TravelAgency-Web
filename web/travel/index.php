<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();
?>

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

    <form action="/travel/" method="POST" class="home-search travel-search row">
        <input type="text" name="search" placeholder="Search">
        <button type="button" onclick="rd('/order/')" class="submit">Boekings</button>
    </form>

    <div class="item-grid">
        <?php

        $pdo = $db->get_pdo();

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $search = $_POST['search'];

            $stmt = $pdo->prepare("SELECT travels.*, locations.name AS location_name FROM travels INNER JOIN locations ON locations.location_id = travels.location_id WHERE travels.name LIKE CONCAT('%', :search, '%') OR locations.name LIKE CONCAT('%', :search, '%')");
            $stmt->execute(["search" => $search]);
        }
        else
        {
            $stmt = $pdo->prepare("SELECT travels.*, locations.name AS location_name FROM travels INNER JOIN locations ON locations.location_id = travels.location_id");
            $stmt->execute();
        }

        $rows = $stmt->fetchAll();
        $template =  "<travel-item id='%s' loc='%s' name='%s' price='%s'></travel-item>";

        foreach ($rows as $row) {
            echo sprintf($template, $row["travel_id"], $row["location_name"], $row["name"], $row["price"]);
        }
        ?>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>