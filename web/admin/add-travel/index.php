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
$pdo = $db->get_pdo();

if ($post)
{
    $travel_id = $_POST['travel_id'];

    $stmt = $pdo->prepare("SELECT * FROM travels WHERE travel_id = :travel_id");
    $stmt->execute(['travel_id' => $travel_id]);
    $travel = $stmt->fetch();
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

$locations = $pdo->query("SELECT * FROM locations");

?>

<main>
    <form action="/php/process/<?php echo $post ? "edit_travel" : "add_travel.php" ?>.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="travel_id" value="<?php if ($post)
        {
            echo $travel_id;
        } ?>">
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer hier.." required maxlength="32" value="<?php if ($post)
            {
                echo $travel['name'];
            } ?>">
        </div>
        <div class="form-item">
            <h2>Prijs</h2>
            <input type="number" name="price" placeholder="Invoer hier.." required step="0.01" maxlength="10"
                   value="<?php if ($post)
                   {
                       echo $travel['price'];
                   } ?>">
        </div>
        <div class="form-item">
            <h2>Locatie</h2>
            <select name="location" required>
                <?php

                foreach ($locations as $location)
                {
                    if ($post && $travel['location_id'] == $location['location_id'])
                    {
                        echo "<option selected value='" . $location['location_id'] . "'>" . $location['name'] . "</option>";
                    }
                    else
                    {
                        echo "<option value='" . $location['location_id'] . "'>" . $location['name'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-item">
            <h2>Beschrijving</h2>
            <textarea name="description" placeholder="Invoer..." required
                      maxlength="140"><?php if ($post) echo $travel['description'] ?></textarea>
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" name="image" placeholder="Invoer hier.."
                   accept="image/png, image/jpeg, image/gif" <?php if (!$post) echo 'required' ?>>
        </div>
        <input type="submit" value="Reis maken" class="submit">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>