<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectInform extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = null;
    private $conditionPara = array();

    function __construct($event)
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
        $this->event = $event;
    }

    public function actionPerformed()
    {
        $post = $this->event->getPost();
        $this->searchNewEval();
    }

    private function searchNewEval()
    {
        $user_id = $_SESSION['userID'];

        //是否有新的評價
        $sql = "SELECT evaluation_id FROM evaluation WHERE member_id =  '$user_id' AND evaluation_read = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array('0'));//array是規定的格式
        $evalNum1 = $stmt->rowCount(PDO::FETCH_NUM); // key point  line

        //是否有未評價的交易
        $sql = "
SELECT trade.trade_id FROM trade LEFT JOIN evaluation ON trade.trade_id = evaluation.trade_id 
WHERE trade.trade_condition = '評價中' 
AND (trade.buyer_id = '$user_id' OR trade.seller_id = '$user_id') 
AND (evaluation.evaluation_evaluator is NULL OR evaluation.evaluation_evaluator != '$user_id')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();//array是規定的格式
        $evalNum2 = $stmt->rowCount(PDO::FETCH_NUM); // key point  line

        //買家的話未讀
        $sql = "SELECT MAX(chat_id),book.book_name,chat.chat_content,member.member_name 
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND trade.seller_id = '$user_id' AND chat.member_id != '$user_id'
AND chat.chat_sellerRead = ?
GROUP BY member.member_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0));//array是規定的格式
        $evalNum3 = $stmt->rowCount(PDO::FETCH_NUM); // key point  line

        //賣家的話未讀
        $sql = "SELECT MAX(chat_id),book.book_name,chat.chat_content,member.member_name 
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND trade.buyer_id = '$user_id' AND chat.member_id != '$user_id'
AND chat.chat_buyerRead = ?
GROUP BY member.member_name";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0));//array是規定的格式
        $evalNum4 = $stmt->rowCount(PDO::FETCH_NUM); // key point  line

        echo json_encode(array("eval_unread" => $evalNum1, "eval_notdo" => $evalNum2, "chat_Buyerunread" => $evalNum3, "chat_Sellerunread" => $evalNum4));//用JSON回傳
        $stmt = null;
    }
}

?>





