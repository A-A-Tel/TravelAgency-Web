<?php session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_SESSION["valid"]) || !$_SESSION["valid"])
{
    echo "<script type='text/javascript'>alert('Not permitted'); window.location.href='/account/'</script>";
    exit;
}
$travel_id = $_POST["travel_id"];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add review</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <form action="/php/process/add-review.php" method="POST">
        <input type="hidden" name="travel_id" value="<?php echo $travel_id ?>">

        <div class="form-item">
            <h2>Score</h2>
            <select required name="score">
                <option value="5">✭✭✭✭✭</option>
                <option value="4">✭✭✭✭</option>
                <option value="3">✭✭✭</option>
                <option value="2">✭✭</option>
                <option value="1">✭</option>
            </select>
        </div>

        <div class="form-item">
            <h2>Content</h2>
            <textarea required name="content" minlength="1" maxlength="120" placeholder="Invoer hier"></textarea>
        </div>

        <input type="submit" value="Recenseer" class="submit">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>
