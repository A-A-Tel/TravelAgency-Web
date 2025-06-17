<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php include getenv("WEB_ROOT") . "php/templates/header.php" ?>

<main class="column align-center">
    <h1 class="title">Uw bestelling</h1>
    <form action="/php/process/order.php" method="POST">

        <div class="form-item">
            <h2>Travel name<br>Begin date<br>end date<br>Price</h2>
        </div>

        <input type="submit" value="Bestellen..." class="submit">
    </form>
</main>

<?php include getenv("WEB_ROOT") . "php/templates/footer.php" ?>
</body>
</html>
