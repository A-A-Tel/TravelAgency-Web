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
    <title>Admin - Accounts</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php include getenv("WEB_ROOT") . "php/templates/header.php"; ?>

<main class="column main-item">
    <?php

    $pdo = $db->get_pdo();

    $template = '
    <div name="review">
        <div>
            <img src="/img/user-items/%s" alt="review">
            <div>
                <span>%s - Created at: %s</span>
            </div>
        </div>
    </div>';

    $rows = $pdo->query("SELECT * FROM users");

    foreach ($rows as $row)
    {
        echo sprintf($template, $row['user_id'], $row['name'], $row['created_at']);
    }

    ?>

</main>

<?php include getenv("WEB_ROOT") . "php/templates/footer.php"; ?>
</body>
</html>
