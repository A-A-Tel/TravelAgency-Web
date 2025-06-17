<?php session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$db->is_user_session()) {
    $db->alert_and_send("Not permitted.", "/travel/");
    exit;
}

$travel_id = $_POST['travel_id'];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("SELECT * FROM bookings WHERE travel_id=:travel_id AND user_id=:user_id");
$stmt->execute(["travel_id" => $travel_id,  "user_id" => $_SESSION['user_id']]);
$booking =  $stmt->fetch();

if ($booking) {
    $db->alert_and_send("Already booked this travel.", "/travel/");
    exit;
}
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
    <form action="/php/process/store_order.php">

        <input type="hidden" name="travel_id" value="<?php echo $travel_id; ?>">

        <div class="form-item">
            <h2>Begindatum</h2>
            <input required type="date" name="begin">
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
