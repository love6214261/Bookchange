<?php

class ConnectToDB{

    private $pdo = null;

    function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=secondhandbookstore;charset=utf8","2hand","miranda226");
    }

    protected function getPDO(){
        return $this->pdo;
    }

}
?>
