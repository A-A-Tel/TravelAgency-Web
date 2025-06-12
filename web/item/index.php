<?php
session_start();

use classes\db;

require_once getenv("WEB_ROOT") . "php/classes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $travel_id = $_POST["travel_id"];


    $sql = "SELECT travels.*,locations.name AS location_name FROM travels INNER JOIN locations ON travels.location_id = locations.location_id WHERE travel_id = :travel_id";

    if (!preg_match("/^[0-9]+$/", $travel_id))
    {
        echo("<script>alert('Invalid user ID'); window.location.href = '/admin/travel/';</script>");
        exit;
    }
    $pdo = new db()->pdo;

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["travel_id" => $travel_id]);
    $travel = $stmt->fetch();

    if (!$travel)
    {
        echo("<script>alert('Item does not exist'); window.location.href = '/admin/travel/';</script>");
        exit;
    }
}
else
{
    header("location: /booking/");
    exit;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Item name</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>

<?php
include getenv("WEB_ROOT") . "php/templates/header.php";


?>

<main class="column main-item">
    <div class="row item-preview">
        <img src="/img/travel-items/<?php echo $travel["travel_id"] ?>" alt="item">
        <div>
            <p>
                Naam: <?php echo $travel["name"]; ?>
                <br>
                Locatie: <?php echo $travel["location_name"]; ?>
                <br>
                Prijs: &euro; <?php echo $travel["price"]; ?>
                <br>
                Beschrijving: <?php echo $travel["description"]; ?>
            </p>
            <div>
                <button style="background: #2AD49C">Toevoegen</button>
                <button style="background: #FF8800">Recenseer</button>
            </div>
        </div>

    </div>
    <h1>Recensies</h1>
    <div name="review">
        <div>
            <img src="/img/avatar-placeholder.png" alt="review">
            <div>
                <div>
                    <img src="/img/star.svg" alt="star">
                    <img src="/img/star.svg" alt="star">
                    <img src="/img/star.svg" alt="star">
                    <img src="/img/star.svg" alt="star">
                    <img src="/img/star.svg" alt="star">
                </div>
                <span>Lorem ipsum dolor sit amet</span>
            </div>
        </div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
        </p>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>

</body>
</html>