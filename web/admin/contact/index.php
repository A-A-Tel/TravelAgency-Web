<?php
require_once getenv('WEB_ROOT') . "php/classes/db.php";

use classes\db;

session_start();

if (!isset($_SESSION['valid']) || !$_SESSION['valid'] || !$_SESSION['admin'])
{
    header("Location: /login/");
    exit;
}
?>

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
include getenv('WEB_ROOT') . "php/templates/header.php";

?>
<main>
    <div class="item-grid grid-wrap">


        <?php


        $template = '
        <div class="item-info">
            <p>
                Datum/Tijd: %s
                <br>
                Naam: %s
                <br>
                Email: %s
                <br>
                Bericht:
                <br>
                %s
            </p>
            <span>
                <button style="background: #e12a37;">Verwijder</button>
                <button style="background: #27d39b;">Beantwoord</button>
            </span>
        </div>
        ';

        $pdo = new db()->getPdo();
        $rows = $pdo->query("SELECT * FROM `contact` ORDER BY `created_at`")->fetchAll();

        foreach ($rows as $row)
        {
            echo sprintf($template, $row['created_at'], $row['name'], $row['email'], $row['message']);
        }

        ?>
    </div>
</main>
<?php
include getenv('WEB_ROOT') . "php/templates/footer.php";
?>
</body>
</html>