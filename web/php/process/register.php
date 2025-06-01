<?php

namespace process;

require_once "../classes/db.php";

use classes\db;


if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $avatar = $_FILES["avatar"];

    $pdo = new db()->getPdo();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();

    if ($user)
    {
        $alert_message = "Email already exists.";
    }
    else
    {
        if
        (
            !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]{2,64}$/u", $name) ||
            !preg_match("/^(?=.{1,320}$)[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) ||
            !preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $pass) ||
            $avatar["error"] != 0
        )
        {
            $alert_message = "Invalid input";
        }
        else
        {
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO `users` (name, email, pass) VALUES (:name, :email, :pass)");
            $stmt->execute(["name" => $name, "email" => $email, "pass" => $pass]);

            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE email = :email");
            $stmt->execute(["email" => $email]);
            $user = $stmt->fetch();
            $avatar["name"] = $user["id"];


            move_uploaded_file($avatar["tmp_name"], getenv("WEB_ROOT") . "img/user-items/" . basename($avatar["name"]));

            $alert_message = "Registration successful, please log in.";
        }
    }
}
else
{
    header("Location /login/");
    exit;
}
echo "<script type='text/javascript'>alert('$alert_message'); window.location.href='/login/'</script>";
