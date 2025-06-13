<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Locaties</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <div class="item-grid">

        <?php

        require_once getenv("WEB_ROOT") . "php/classes/db.php";

        use classes\db;

        $db = new db();
        $pdo = $db->get_pdo();
        $rows = $pdo->query("SELECT * FROM locations");

        $template = "
        <div class=\"item\">
            <div style=\"background: #000 url('/img/location-items/%s') no-repeat center / 100%% 100%%\"></div>
            <span>%s</span>
        </div>
        ";

        foreach ($rows as $row)
        {
            echo sprintf($template, $row["location_id"], $row["name"]);
        }
        ?>

    </div>

</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>