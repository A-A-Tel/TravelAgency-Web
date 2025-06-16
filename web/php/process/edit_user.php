<?php
session_start();
require_once getenv("WEB_ROOT") . "php/classes/db.php";

use classes\db;

$db = new db();

if (!$db->is_user_session() || $_SERVER["REQUEST_METHOD"] !== "POST")
{
    $db->alert_and_send("Not permitted", "/login/");
    exit;
}

$user_id = $db->is_admin_session() ? $_POST["user_id"] : $_SESSION["id"];

$name = $_POST['name'];
$email = $_POST['email'];

$pass = $_POST['pass'];
$change_pass = !empty($pass);

$avatar = $_FILES["avatar"];

$pdo = $db->get_pdo();

if
(
    !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]{2,64}$/u", $name) ||
    !preg_match("/^(?=.{1,320}$)[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) ||
    (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass) && $change_pass)
)
{
    $db->alert_and_send("Invalid input", "/register/");
    exit;
}

$stmt = $pdo->prepare("SELECT users.user_id FROM users WHERE users.email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

if ($user && $user["user_id"] !== $user_id)
{
    var_dump($user, $user_id);
//    $db->alert_and_send("Email already registered", "/account/");
    exit;
}

if ($change_pass)
{
    $stmt = $pdo->prepare("UPDATE users SET name=:name, email=:email, pass=:pass WHERE user_id=:user_id");
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $stmt->execute(["name" => $name, "email" => $email, "pass" => $pass, "user_id" => $user_id]);
}
else
{
    $stmt = $pdo->prepare("UPDATE users SET name=:name, email=:email WHERE user_id=:user_id");
    $stmt->execute(["name" => $name, "email" => $email, "user_id" => $user_id]);
}

if (isset($avatar))
{
    $avatar['name'] = $user_id;
    move_uploaded_file($avatar['tmp_name'], getenv("WEB_ROOT") . "img/user-items/" . basename($avatar['name']));
}

if (!$db->is_admin_session())
{
    require_once getenv("WEB_ROOT") . "php/process/logout.php";
    $db->alert_and_send("Successfully updated user", "/login/");
}
else
{
    $db->alert_and_send("Successfully updated user", "/admin/accounts/");
}