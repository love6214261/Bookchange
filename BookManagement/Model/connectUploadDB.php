<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectUploadDB extends ConnectToDB
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
        $bookPicture = $post['bookPicture'];
        $publishingHouse = $post['publishingHouse'];
        $bname = $post['bname'];
        $author = $post['author'];
        $ISBN = $post['ISBN'];
        $bookClass = $post['bookClass'];
        $twoprice = $post['twoprice']; //書二手價
        $bookcon = $post['bookcon']; //書況
        $buyer=$_SESSION['userID'];
        $state='上架中';
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間
        
        $this->uploadBooks($bookPicture,$publishingHouse,$bname,$author,$ISBN,$bookClass,$twoprice,$bookcon,$buyer,$state,$time);
    }

    private function uploadBooks($bookPicture,$publishingHouse,$bname,$author,$ISBN,$bookClass,$twoprice,$bookcon,$buyer,$state,$time)
    {
        $sql = "";


        $sql = "
      INSERT INTO book (book_class,book_name,book_isbn,book_author,book_publishinghouse,book_picture,book_upcondition,book_time,book_condition,book_twoprice,member_id) 
      VALUE('$bookClass','$bname','$ISBN','$author','$publishingHouse','$bookPicture','$state','$time','$bookcon','$twoprice','$buyer') 
    ";
        //更新類別和賣方 //+buyer_id
        $sql_u = "
    UPDATE book
    SET book_picture=
    (SELECT book_picture
     FROM allbook
     WHERE ISBN='$ISBN'
    )
    WHERE member_id='$buyer' AND book_time='$time'
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
       //$stmt_u = $this->pdo->exec($sql_u);

        if($stmt)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}