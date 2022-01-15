<?php
/*
session_start();
//上方語法為啟用session，此語法要放在網頁最前方-->
header("Content-Type:text/html; charset=UTF-8");
$id = $_SESSION['username'];
/**
 * Created by PhpStorm.
 * User: Allen Hsu
 * Date: 2016/7/7
 * Time: 下午 03:56
 */

include("../connect_to_DB.php");


$book="document.json";

/*讀取書櫃組的書本json檔*/
    $file = fopen($book, "r");
    while (!feof($file)) {
        $content = fread($file, 10000);
    }
    fclose($file);

/*存進資料庫*/
    $content = json_decode($content);
    foreach ($content as $key => $value) {
        $bookCover = $value->bookCover;
        $bookName = $value->bookName;
        $isbn = $value->isbn;
        $editor = $value->editor;
        $price = $value->price;
        $publishingHouse = $value->publishingHouse;
        $postDate = $value->postDate;
        $class = $value->class;
        $seller = $value->seller;
        
        $sql = "INSERT INTO book (author,bookclass,postdate,price,ISBN,bookname,publishingHouse,id_seller) values ('$editor','$class','$postDate','$price','$isbn','$bookName','$publishingHouse','$seller')";
        /*$dbh->exec($sql);*/

        if($dbh->exec($sql))
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }
        
    }

?>