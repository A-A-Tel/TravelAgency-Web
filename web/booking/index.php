<?php session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session()) {
    $db->alert_and_send("Not permitted.", "/travel/");
    exit;
}

$travel_id = $_POST['travel_id'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php include getenv("WEB_ROOT") . "php/templates/header.php" ?>

<main>
    <form action="/php/process/store_order.php" method="POST">

        <input type="hidden" name="travel_id" value="<?php echo $travel_id; ?>">

        <div class="form-item">
            <h2>Begindatum</h2>
            <input required type="date" name="start">
        </div>
        <div class="form-item">
            <h2>Einddatum</h2>
            <input required type="date" name="end">
        </div>

        <input type="submit" value="Boeken" class="submit">
    </form>
</main>

<?php include getenv("WEB_ROOT") . "php/templates/footer.php" ?>
</body>
</html>
