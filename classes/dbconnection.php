<?php

class Db
{
    private $hostname = "localhost";
    private $dbname = "medlab";
    private $username = "root";
    private $password = "";

    public function connect()
    {

        try {
            $dsn = "mysql:hostname=$this->hostname; dbname=$this->dbname";
            $conn = new PDO($dsn, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOEXCEPTION $e) {
            echo "Db connection failed" . $e->getMessage();
        }
    }
}

// $newobject = new Db();
// $newobject->connect();
// echo "<pre>";
// print_r($newobject);
// echo "</pre>";
