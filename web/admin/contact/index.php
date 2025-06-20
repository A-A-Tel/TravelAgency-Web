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




        $pdo = $db->get_pdo();
        $rows = $pdo->query("SELECT * FROM `contact` WHERE answered=0 ORDER BY `created_at`")->fetchAll();

        foreach ($rows as $row)
        {
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
                <button onclick="adminAnswerContact(`%s`)" style="background: #27d39b;">Beantwoord</button>
            </span>
        </div>
        ';


            echo sprintf($template, $row['created_at'], $row['name'], $row['email'], $row['message'], $row['contact_id']);
        }

        ?>
    </div>
</main>
<?php
include getenv('WEB_ROOT') . "php/templates/footer.php";
?>
</body>
</html>