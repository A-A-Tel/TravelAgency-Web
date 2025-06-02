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
}