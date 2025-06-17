<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session())
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$user_id = $db->is_admin_session() ?  $_POST['user_id'] :  $_SESSION['id'];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit account</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php include getenv("WEB_ROOT") . "php/templates/header.php" ?>

<main>
    <form method="POST" action="/php/process/edit_user.php" enctype='multipart/form-data'>
        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <div class="form-item">
            <h2>Naam</h2>
            <input value="<?php echo $user['name'] ?>" type="text" name="name" placeholder="Invoer..." minlength="2" maxlength="64" required>
        </div>
        <div class="form-item">
            <h2>Email</h2>
            <input value="<?php echo $user['email'] ?>" type="email" name="email" placeholder="Invoer..." minlength="3" maxlength="320" required>
        </div>
        <div class="form-item">
            <h2>Wachtwoord</h2>
            <input value="" type="password" name="pass" placeholder="Invoer..." minlength="8">
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="avatar" placeholder="Invoer..."
                   minlength="8">
        </div>
        <input type="submit" value="Bewerken" class="submit">
    </form>
</main>

<?php include getenv("WEB_ROOT") . "php/templates/footer.php" ?>
</body>
</html>
