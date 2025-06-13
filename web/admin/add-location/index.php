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
    <title>Admin - Add Location</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <form action="/php/process/add_location.php" method="POST" enctype='multipart/form-data'>
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer hier.." required maxlength="32">
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="image" placeholder="Invoer hier.." required>
        </div>
        <input class="submit" type="submit" value="Toevoegen">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>

</body>
</html>
