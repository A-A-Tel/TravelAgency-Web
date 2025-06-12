<?php
$logo_link = "/";
if (isset($_SESSION["valid"]) && $_SESSION["valid"])
{
    $login_button = "<button onclick='rd(`/account/`)' class='nav-button login-button'>Account</button>";
    $avatar_path = "/img/user-items/{$_SESSION['id']}";

    if (isset($_SESSION["admin"]) && $_SESSION["admin"])
    {
        $logo_link = "/admin/";
    }
}
else
{
    $login_button = "<button onclick='rd(`/login/`)' class='nav-button login-button'>Login</button>";
}
?>

<script src="/js/main.js"></script>
<header>

    <?php if (isset($_SESSION["valid"]) && $_SESSION["valid"]) echo '<button onclick="rd(`/php/process/logout.php`)" class="mode-button"></button>' ?>
    <nav>
        <button onclick="rd('/')" class="nav-button">Start</button>
        <button onclick="rd('/about/')" class="nav-button">Over</button>
        <button onclick="rd('/locations/')" class="nav-button">Locaties</button>
    </nav>
    <a href="<?php echo $logo_link ?>"><img src="/img/logo.png" alt="logo"></a>
    <nav>
        <button onclick="rd('/booking/')" class="nav-button">Boeken</button>
        <button onclick="rd('/contact/')" class="nav-button">Contact</button>
        <?php echo $login_button; ?>
    </nav>
    <?php if (isset($_SESSION["valid"]) && $_SESSION["valid"]) echo "<img src='$avatar_path' alt='avatar' class='avatar'>" ?>
</header>