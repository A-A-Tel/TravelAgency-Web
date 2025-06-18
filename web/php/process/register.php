<?php
require_once "../classes/db.php";

use classes\db;

$db = new db();

if ($_SERVER["REQUEST_METHOD"] !== "POST")
{
    $db->alert_and_send("Not permitted", "/register/");
}

$name = $_POST["name"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$avatar = $_FILES["avatar"];

$pdo = $db->get_pdo();
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();

if ($user)
{
    $db->alert_and_send("Email already exits", "/register/");
    exit;
}

if
(
    !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]{2,64}$/u", $name) ||
    !preg_match("/^(?=.{1,320}$)[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) ||
    !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass) ||
    $avatar["error"] != 0
)
{
    $db->alert_and_send("Invalid input", "/register/");
    exit;
}

$pass = password_hash($pass, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO `users` (name, email, pass) VALUES (:name, :email, :pass)");
$stmt->execute(["name" => $name, "email" => $email, "pass" => $pass]);

$stmt = $pdo->prepare("SELECT * FROM `users` WHERE email = :email");
$stmt->execute(["email" => $email]);
$user = $stmt->fetch();
$avatar["name"] = $user["user_id"];

move_uploaded_file($avatar["tmp_name"], getenv("WEB_ROOT") . "img/user-items/" . basename($avatar["name"]));

$db->alert_and_send("Successfully registered", "/login/");