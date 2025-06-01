<?php

namespace process;

use classes\db;

require_once "../classes/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $pdo = new db()->getPdo();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(["email" => $email]);
    $user = $stmt->fetch();

    if (!$user)
    {
        $alert_message = "Invalid input";
    }
    else
    {
        if (!password_verify($pass, $user["pass"]))
        {
            $alert_message = "Invalid input";
        }
        else
        {
            $alert_message = "Login successful";
            session_start();
            $_SESSION["valid"] = true;
            $_SESSION["id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["admin"] = $user["admin"];
        }
    }
}
else
{
    header("Location: /login/");
    exit;
}
echo("<script>alert('$alert_message'); window.location.href = '/account/';</script>");