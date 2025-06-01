<?php

use process\db;

$alert_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $pdo = new db()->getPdo();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();

    if ($user)
    {
        $alert_message = "Email already exists.";
    }
    else if
    (
        !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]+$/u", $name) ||
        !preg_match("/\\b[\\w.%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}\\b/", $email) ||
        !preg_match("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$", $pass)
    )
    {
        $alert_message = "Invalid input.";
    }
    else
    {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, pass) VALUES (:name, :email, :pass)");
        $stmt->execute(["name" => $name, "email" => $email, "pass" => $pass]);
        $alert_message = "Registration successful, please log in.";
    }
}
else
{
    header("Location /login/");
    exit;
}
header("Location /login/");
echo "<script type='text/javascript'>alert('$alert_message');</script>";
