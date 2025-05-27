<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv('WEB_ROOT') . "/php/templates/header.php";
?>

<main class="row align-center justify-center">
    <a href="//">
        <div class="admin-item">
            <img src="/img/books.png" alt="books">
            <span>Boekings</span>
        </div>
    </a>
    <a href="#">
        <div class="admin-item">
            <img src="/img/airport.png" alt="planes :D">
            <span>Reizen beheren</span>
        </div>
    </a>
    <a href="#">
        <div class="admin-item">
            <img src="/img/scammers.png" alt="scammers">
            <span>Contact</span>
        </div>
    </a>
</main>

<?php
include getenv('WEB_ROOT') . "/php/templates/footer.php";
?>
</body>
</html>