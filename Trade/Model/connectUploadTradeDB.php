<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectUploadTradeDB extends ConnectToDB
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

        $book_id=$post['book_id'];
        $RorB=$post['RorB'];
        $buyer_id=$post['buyer_id'];
        $state='交易中';
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間
        $time5 = date('Y-m-d H:i:s', time()+5*86400);

        $this->uploadTrade($book_id,$buyer_id,$state,$time, $time5,$RorB);
    }

    private function uploadTrade($book_id,$buyer_id,$state,$time, $time5,$RorB)
    {
        $sql = "";


        $sql = "
      INSERT INTO trade (trade_condition,trade_start,trade_end,buyer_id,seller_id,book_id,trade_rentOrBuy) 
      VALUE('$state','$time','$time5','$buyer_id','0','$book_id','$RorB') 
    ";

        $sql_u = "
    UPDATE trade
    SET seller_id=
    (SELECT member_id
     FROM book
     WHERE book_id='$book_id'
    )
    WHERE buyer_id='$buyer_id' AND trade_start='$time'
    ";

        $sql_b = "
    UPDATE book
    SET book_upcondition='$state'
    WHERE book_id='$book_id' 
    ";

        $stmt = $this->pdo->exec($sql);
        $stmt_u = $this->pdo->exec($sql_u);
        $stmt_b = $this->pdo->exec($sql_b);

        if($stmt && $stmt_u && $stmt_b)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}