<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
    include getenv("WEB_ROOT") . "/php/templates/header.php";
?>

<main class="main home-main">
    <div class="home-intro">
        <h1>Waar ga jij deze keer heen?</h1>
        <p>
            Hier bij <b>Reis 2000</b> heb je keuze in allerlei assortimenten. Bekijk met al onze booking-deals of scroll gerust
            verder en ontdek de wereld.
        </p>
    </div>
    <form action="#" method="POST" class="home-search">
        <input type="text" name="search" placeholder="Search">
    </form>
</main>

<?php
    include getenv("WEB_ROOT") . "/php/templates/footer.php";
?>

<script src="/js/main.js"></script>
</body>
</html>