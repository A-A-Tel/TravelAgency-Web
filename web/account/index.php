<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session()) {
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main class="column flex-center margin-vertical">
    <div class="row item-preview">
        <img src="/img/user-items/<?php echo $_SESSION["id"] ?>" alt="item">
        <div>
            <p>
                Naam: <?php echo $_SESSION["name"]; ?>
                <br>
                Email: <?php echo $_SESSION["email"]; ?>
                <br>
                Wachtwoord: ********
            </p>
            <div>
                <button style="background: #F00">Verwijder</button>
                <button style="background: #FF8800">Bewerk</button>
            </div>
        </div>
    </div>


    <div class="item-grid">
        <div class="item">
            <div></div>
            <span>Nederland</span>
        </div>
        <div class="item">
            <div></div>
            <span>Griekenland</span>
        </div>
        <div class="item">
            <div></div>
            <span>Noorwegen</span>
        </div>
        <div class="item">
            <div></div>
            <span>Mexico</span>
        </div>
        <div class="item">
            <div></div>
            <span>Brazilië</span>
        </div>
        <div class="item">
            <div></div>
            <span>Argentinië</span>
        </div>
        <div class="item">
            <div></div>
            <span>India</span>
        </div>
        <div class="item">
            <div></div>
            <span>Spanje</span>
        </div>
        <div class="item">
            <div></div>
            <span>Egypte</span>
        </div>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>