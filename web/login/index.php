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
    <form method="POST">
        <div class="form-item">
            <h2>Email</h2>
            <input type="email" name="email" placeholder="Invoer..." required>
        </div>
        <div class="form-item">
            <h2>Wachtwoord</h2>
            <input type="password" name="pass" placeholder="Invoer..." required>
        </div>

        <span class="row gap-5vw">
            <input type="submit" value="Registreren " class="submit" formaction="/php/process/register.php">
            <input type="submit" value="Inloggen" class="submit" formaction="/php/process/login.php">
        </span>
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>
</body>
</html>