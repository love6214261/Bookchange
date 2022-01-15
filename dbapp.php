<?php

class ConnectToDB{

    private $pdo = null;

    function __construct(){
        $this->pdo = new PDO("mysql:host=140.115.80.105;dbname=bookcam;charset=utf8","test","password");
    }

    protected function getPDO(){
        return $this->pdo;
    }

}
?>