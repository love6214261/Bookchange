<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectUploadNot extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = array();


    function __construct($event)
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
        $this->event = $event;
    }

    public function actionPerformed()
    {
        $post = $this->event->getPost();

        $publishingHouse = $post['publishingHouse'];
        $bname = $post['bname'];
        $author = $post['author'];
        $price = $post['price'];
        $ISBN = $post['ISBN'];
        $bookClass = $post['bookClass'];
        $twoprice = $post['twoprice']; //書二手價
        $bookcon = $post['bookcon']; //書況
        $buyer=$_SESSION['userID'];
        $rent=$post['rent'];
        $state='上架中';
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間

        $this->uploadBooks($publishingHouse,$bname,$author,$price,$ISBN,$bookClass,$twoprice,$bookcon,$buyer,$rent,$state,$time);
    }

    private function uploadBooks($publishingHouse,$bname,$author,$price,$ISBN,$bookClass,$twoprice,$bookcon,$buyer,$rent,$state,$time)
    {
        $sql = "";


        $sql = "
      INSERT INTO book (book_class,book_name,book_isbn,book_author,book_price,book_publishinghouse,book_picture,book_upcondition,book_time,book_condition,book_twoprice,book_rentOrNot,member_id) 
      VALUE('$bookClass','$bname','$ISBN','$author','$price','$publishingHouse',null,'$state','$time','$bookcon','$twoprice','$rent','$buyer') 
    ";
        //更新類別和賣方 //+buyer_id
        $sql_u = "
    UPDATE book
    SET book_picture=
    (SELECT allbook_picture
     FROM allbook
     WHERE allbook_isbn='$ISBN'
    )
    WHERE member_id='$buyer' AND book_time='$time'
    ";

        $sql_a = "
    UPDATE allbook
    SET allbook_condition='1'
    WHERE allbook_member='$buyer' AND allbook_isbn='$ISBN'
    ";
        /*
            //新增trade
           $sqlt="
              INSERT INTO trade (trade_condition,trade_start,trade_end,book_condition,book_twoprice,buyer_id,seller_id,book_id) 
              VALUES ('$state','$time',null,'$bookcon','$twoprice',null,'$buyer','0')
            ";
        
            //更新trade
            $sqlt_u="
              UPDATE trade
              SET book_id=
              ( SELECT `book_id`
                FROM `book`
                WHERE book_isbn = '$ISBN' AND buyer_id='$buyer')
              WHERE book_id='0'
            ";
        */

//&& $dbh->exec($sqlt) && $dbh->exec($sqlt_u)
        $stmt = $this->pdo->exec($sql);
        $stmt_u = $this->pdo->exec($sql_u);
        $stmt_a = $this->pdo->exec($sql_a);

        if($stmt && $stmt_u && $stmt_a)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}