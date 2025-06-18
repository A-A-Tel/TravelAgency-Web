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

$post = $_SERVER['REQUEST_METHOD'] === 'POST';

if ($post)
{
    $location_id = $_POST['location_id'];

    $pdo = $db->get_pdo();
    $stmt = $pdo->prepare("SELECT locations.name FROM locations WHERE locations.location_id = :location_id");
    $stmt->execute([':location_id' => $location_id]);
    $name = $stmt->fetch()['name'];
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
    <form action="/php/process/<?php echo $post ? "edit_location" : "add_location" ?>.php" method="POST" enctype='multipart/form-data'>
        <input type="hidden" name="location_id" value="<?php if ($post) echo $location_id ?>">
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer hier.." required maxlength="32" value="<?php if ($post) echo $name ?>">
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="image" placeholder="Invoer hier.." <?php if (!$post) echo "required" ?>>
        </div>
        <input class="submit" type="submit" value="Toevoegen">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>

</body>
</html>
