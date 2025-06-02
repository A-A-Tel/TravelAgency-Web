<?php

namespace process;

require_once "../classes/db.php";

use classes\db;


if ($_SERVER["REQUEST_METHOD"] === "POST")
{
    $pdo = new db()->pdo;

    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    if
    (
        !preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžæÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.'-]{2,64}$/u", $name) ||
        !preg_match("/^(?=.{1,320}$)[\w.%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) ||
        !preg_match('/^[\p{L}\p{N}\p{P}\p{S}\p{Z}]+$/u', $message)
    )
    {
        $alert_message = "Invalid input";
    }
    else
    {
        $stmt = $pdo->prepare("INSERT INTO contact (name, email, message) VALUES(:name, :email, :message)");
        $stmt->execute(["name" => $name, "email" => $email, "message" => $message]);

        $alert_message = "Contact request sent";
    }
}
else
{
    header("location: /contact/");
    exit();
}
echo("<script>alert('$alert_message'); window.location.href = '/contact/';</script>");