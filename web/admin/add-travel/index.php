<?php
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
    <title>Admin - Add Travel</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";

require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$pdo = new db()->pdo;
$locations = $pdo->query("SELECT * FROM locations");

?>

<main>
    <form action="/php/process/add_travel.php" method="POST" enctype="multipart/form-data">
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer hier.." required maxlength="32">
        </div>
        <div class="form-item">
            <h2>Prijs</h2>
            <input type="number" name="price" placeholder="Invoer hier.." required step="0.01" maxlength="10">
        </div>
        <div class="form-item">
            <h2>Locatie</h2>
            <select name="location" required>
                <?php foreach ($locations as $location): echo "<option value='" . $location["id"] . "'>" . $location["name"] . "</option>"; endforeach; ?>
            </select>
        </div>
        <div class="form-item">
            <h2>Beschrijving</h2>
            <textarea name="description" placeholder="Invoer..." required maxlength="140"></textarea>
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" name="image" placeholder="Invoer hier.." required accept="image/png, image/jpeg, image/gif">
        </div>
        <input type="submit" value="Reis maken" class="submit">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>