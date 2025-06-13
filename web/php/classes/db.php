<?php

namespace classes;

use PDO;

class db
{

    public PDO $pdo {
        get {
            return $this->pdo;
        }
    }

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        $this->pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
    }

    public function is_user_session(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) return false;

        return isset($_SESSION['valid']) && $_SESSION['valid'];
    }

    public function is_admin_session(): bool
    {
        return $this->is_user_session() && $_SESSION['is_admin'];
    }

    public function alert_and_send(string $message, string $href): void
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href='$href'</script>";
    }
}