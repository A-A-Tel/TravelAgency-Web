<?php

session_start() ?>

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
        <?php

        require_once getenv("WEB_ROOT") . "php/classes/db.php";
        use classes\db;


        $pdo = new db()->pdo;

        $rows = $pdo->query("SELECT * FROM travels")->fetchAll();
        $template =  "<booking-item id='%s' loc='%s' name='%s' price='%s'></booking-item>";

        foreach ($rows as $row) {
            $stmt = $pdo->prepare("SELECT * FROM locations WHERE id=:id");
            $stmt->execute([":id" => $row["location_id"]]);
            $location_name = $stmt->fetch()["name"];
            echo sprintf($template, $row["id"], $location_name, $row["name"], $row["price"]);
        }

        ?>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>