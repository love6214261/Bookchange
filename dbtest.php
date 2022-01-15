<?php

class ConnectToDB{

    private $pdo = null;

    function __construct(){
        $this->pdo = new PDO("mysql:host=140.112.107.186;dbname=mydb;charset=utf8","test","password");
    }

    protected function getPDO(){
        return $this->pdo;
    }

}
?>