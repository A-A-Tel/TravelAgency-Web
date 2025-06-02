<?php
session_start();

if (!isset($_SESSION['valid']) || !$_SESSION['valid'] || !$_SESSION['admin'])
{
    header("Location: /login/");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Add Location</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="shortcut icon" href="/img/favicon.svg" type="image/x-icon">
</head>
<body>
<?php
include getenv("WEB_ROOT") . "php/templates/header.php";
?>

<main>
    <form action="/php/process/add_location.php" method="POST" enctype='multipart/form-data'>
        <div class="form-item">
            <h2>Naam</h2>
            <input type="text" name="name" placeholder="Invoer hier.." required>
        </div>
        <div class="form-item">
            <h2>Afbeelding</h2>
            <input type="file" accept="image/png, image/gif, image/jpeg" name="image" placeholder="Invoer hier.." required>
        </div>
        <input class="submit" type="submit" value="Toevoegen">
    </form>
</main>

<?php
include getenv("WEB_ROOT") . "php/templates/footer.php";
?>

</body>
</html>
