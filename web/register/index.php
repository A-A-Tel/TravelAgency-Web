<?php session_start() ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <form method="POST" action="/php/process/register.php" enctype='multipart/form-data'>
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer..." minlength="2" maxlength="64" required>
        </div>
        <div class="form-item">
            <h2>Email</h2>
            <input type="email" name="email" placeholder="Invoer..." minlength="3" maxlength="320" required>
        </div>
        <div class="form-item">
            <h2>Wachtwoord</h2>
            <input type="password" name="pass" placeholder="Invoer..." minlength="8" required>
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="avatar" placeholder="Invoer..." minlength="8" required>
        </div>

        <span class="row gap-5vw">
            <a class="submit" href="/login/">Inloggen</a>
            <input type="submit" value="Registreren " class="submit">
        </span>
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>