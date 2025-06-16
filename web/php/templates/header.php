<?php
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();
$user_session = $db->is_user_session();
$logo_link = "/";

if ($user_session)
{
    $avatar_path = "/img/user-items/{$_SESSION['id']}";

    if ($db->is_admin_session())
    {
        $logo_link = "/admin/";
        $login_button = "<button onclick='rd(`/admin/accounts/`)' class='nav-button login-button'>Accounts</button>";
    }
    else
    {
        $login_button = "<button onclick='rd(`/account/`)' class='nav-button login-button'>Account</button>";
    }
}
else
{
    $login_button = "<button onclick='rd(`/login/`)' class='nav-button login-button'>Login</button>";
}
?>

<script src="/js/main.js"></script>
<header>

    <?php if ($user_session) echo '<button onclick="rd(`/php/process/logout.php`)" class="mode-button"></button>' ?>
    <nav>
        <button onclick="rd('/')" class="nav-button">Start</button>
        <button onclick="rd('/about/')" class="nav-button">Over</button>
        <button onclick="rd('/locations/')" class="nav-button">Locaties</button>
    </nav>
    <a href="<?php echo $logo_link ?>"><img src="/img/logo.png" alt="logo"></a>
    <nav>
        <button onclick="rd('/travel/')" class="nav-button">Reizen</button>
        <button onclick="rd('/contact/')" class="nav-button">Contact</button>
        <?php echo $login_button; ?>
    </nav>
    <?php if ($user_session) echo "<img src='$avatar_path' alt='avatar' class='avatar'>" ?>
</header>