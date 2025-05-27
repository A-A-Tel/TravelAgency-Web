<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
    include getenv("WEB_ROOT") . "/php/templates/header.php";
?>

<main class="column flex-center">
    <div class="row item-preview">
        <img src="/img/placeholder.svg" alt="item">
        <div>
            <p>
                Naam: Lorem
                <br>
                Geboortedatum: Ipsum
                <br>
                Email: Dolor
                <br>
                Wachtwoord: ****
            </p>
            <div>
                <button style="background: #F00">Verwijder</button>
                <button style="background: #FF8800">Bewerk</button>
            </div>
        </div>
    </div>



</main>

<?php
    include getenv("WEB_ROOT") . "/php/templates/footer.php";
?>
</body>
</html>