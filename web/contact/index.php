<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact</title>
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <form action="/php/process/contact.php" method="POST">
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer..." required>
        </div>
        <div class="form-item">
            <h2>Email</h2>
            <input type="email" name="email" placeholder="Invoer..." required>
        </div>
        <div class="form-item">
            <h2>Bericht</h2>
            <textarea name="message" placeholder="Invoer..." required></textarea>
        </div>
        <input type="submit" value="Verzenden" class="submit">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>