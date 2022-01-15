<?php

define('DB_NAME','secondhandbookstore');
define('DB_USER','2hand');
define('DB_PASSWORD','miranda226');
define('DB_HOST','localhost');
define('DB_TYPE','mysql');
$dsn = DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME;
$dbh = new PDO($dsn, DB_USER, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>