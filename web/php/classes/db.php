<?php

namespace classes;

use PDO;

class db
{

    private PDO $pdo;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $name = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASS');

        $this->pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
    }

    public function get_pdo(): PDO {
        return $this->pdo;
    }

    /**
     * <p>
     * Return true if a session is valid.
     * Please note that this does not return false if the user is an admin.
     * This will also return false when a session is not active.
     * </p>
     * @return bool
     * @see is_admin_session for extended functionality
     */
    public function is_user_session(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) return false;

        return isset($_SESSION['valid']) && $_SESSION['valid'];
    }

    /**
     * <p>
     * Return true if a user is admin.
     * This will also return false when a session is not active.
     *
     * </p>
     * @return bool
     * @uses is_user_session
     */
    public function is_admin_session(): bool
    {
        return $this->is_user_session() && $_SESSION['is_admin'];
    }

    public function alert_and_send(string $message, string $href): void
    {
        echo "<script type='text/javascript'>alert('$message'); window.location.href='$href'</script>";
    }
}