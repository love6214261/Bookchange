<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectUploadEndDB extends ConnectToDB
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
        $buyer=$post['userID'];

        if ($this->searchTrade($buyer, $book_id) != null) {
            $SorF=$this->searchTrade($buyer, $book_id);
            $this->uploadTrade($book_id, $SorF, $buyer);
        }
        else{
            echo '評價完成!';
        }
    }

    private function searchTrade($buyer, $book_id)
    {
        $sql = "SELECT COUNT(evaluation.member_id),evaluation_condition
                FROM  evaluation,trade
                where evaluation.trade_id=trade.trade_id AND trade.book_id = ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $waitData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        if ($waitData[0]['COUNT(evaluation.member_id)']>= 2) {

            if($waitData[0]['evaluation_condition']=="正常完成" ){

                $SorF="交易成功";
            }
            else{
                $SorF="交易失敗";
            }
            $stmt = null;
            return $SorF;
        } else {
            $stmt = null;
            return null;
        }
    }

    private function uploadTrade($book_id,$SorF,$buyer)
    {
        $sql = "";

        $sql = "
    UPDATE book
    SET book_upcondition='$SorF'
    WHERE book_id='$book_id' 
    ";
        $sql_b = "
    UPDATE trade
    SET trade_condition='$SorF'
    WHERE book_id='$book_id' 
    ";

        $stmt= $this->pdo->exec($sql);
        $stmt_b = $this->pdo->exec($sql_b);

        if($stmt&& $stmt_b)
        {
            echo '交易完成!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}