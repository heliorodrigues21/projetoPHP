<?php

    function connection(){

        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
        return new \PDO($dsn, DB_USER, DB_PASSWORD);
    }

?>