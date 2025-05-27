<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Over</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "/php/templates/header.php";
?>

<main class="main about-main column">
    <div class="about-description">
        <h1>Wat is Reis2000?</h1>
        <p>
            Reis2000 is een reis platform waarbij wij zorgen dat de passagier zo snel en veilig mogelijk aan komt op uw
            bestemming
        </p>
    </div>
    <div class="about-container">
        <div class="about-description">
            <h1>Wie zijn wij?</h1>
            <p>
                Wij van Reis2000 zijn een groep gespecialiseerd in het zorgen voor de beste booking deals. Wilt u
                contact met ons opnemen? Ga dan naar onze contactpagina.
            </p>
        </div>
        <div class="column about-points">
            <div class="row about-point">
                <img src="/img/ok.svg" alt="ok">
                <span>Vertrouwde reviews op Trustpilot</span>
            </div>
            <div class="row about-point">
                <img src="/img/ok.svg" alt="ok">
                <span>Bookings te annuleren op elk moment</span>
            </div>
            <div class="row about-point">
                <img src="/img/ok.svg" alt="ok">
                <span>Veel verschillende activiteiten</span>
            </div>
            <div class="row about-point">
                <img src="/img/ok.svg" alt="ok">
                <span>Routes door heel nederland</span>
            </div>
            <div class="row about-point">
                <img src="/img/ok.svg" alt="ok">
                <span>Allerlei soorten aanbiedingen en actie's</span>
            </div>
        </div>
    </div>
</main>

<?php
include getenv("WEB_ROOT") . "/php/templates/footer.php";
?>
</body>
</html>