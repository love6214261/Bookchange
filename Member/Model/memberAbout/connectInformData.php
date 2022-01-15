<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectInformData extends ConnectToDB
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
        $user_id = $_SESSION['userID'];
        switch ($post['ID']) {
            case 'BuyerChat':
                $this->searchBuyerChat($user_id);
                break;
            case 'SellerChat':
                $this->searchSellerChat($user_id);
                break;
            case 'EvalNot':
                $this->searchEvalNot($user_id);
                break;
            case 'EvalNew':
                $this->searchEvalNew($user_id);
                break;
        }
    }

    private function searchBuyerChat($user_id)
    {

        $sql = "SELECT MAX(chat_id),book.book_name,chat.chat_content,member.member_name,book.book_id 
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND trade.seller_id = '$user_id' AND chat.member_id != '$user_id'
AND chat.chat_sellerRead = ?
GROUP BY chat.book_id
";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0));//array是規定的格式
        $chatData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        foreach ($chatData as $data) {
            $chat[$data['MAX(chat_id)']] = array(
                'book_name' => $data['book_name'],
                'book_id' => $data['book_id'],
                'chat_content' => $data['chat_content'],
                'member_name' => $data['member_name']
            );
        }
        echo json_encode($chatData);//用JSON回傳
        $stmt = null;
    }

    private function searchSellerChat($user_id)
    {

        $sql = "SELECT MAX(chat_id),book.book_name,chat.chat_content,member.member_name,book.book_id
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND trade.buyer_id = '$user_id' AND chat.member_id != '$user_id'
AND chat.chat_buyerRead = ?
GROUP BY chat.book_id
";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0));//array是規定的格式
        $chatData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        foreach ($chatData as $data) {
            $chat[$data['MAX(chat_id)']] = array(
                'book_name' => $data['book_name'],
                'book_id' => $data['book_id'],
                'chat_content' => $data['chat_content'],
                'member_name' => $data['member_name']
            );
        }
        echo json_encode($chatData);//用JSON回傳
        $stmt = null;
    }

    private function searchEvalNew($user_id)
    {
        $sql = "SELECT evaluation_id,book.book_name,evaluation.evaluation_score,evaluation.evaluation_advise,evaluation_condition,member.member_name FROM evaluation,member,book,trade 
WHERE evaluation.member_id = '$user_id' 
AND evaluation.evaluation_evaluator = member.member_id 
AND evaluation_read = ? 
AND evaluation.trade_id = trade.trade_id 
AND trade.book_id = book.book_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array('0'));//array是規定的格式
        $evalData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        foreach ($evalData as $data) {
            $chat[$data['evaluation_id']] = array(
                'evaluation_score' => $data['evaluation_score'],
                'evaluation_advise' => $data['evaluation_advise'],
                'evaluation_condition' => $data['evaluation_condition'],
                'member_name' => $data['member_name'],
                'book_name' => $data['book_name']
            );
        }
        echo json_encode($evalData);//用JSON回傳
        $stmt = null;
    }

    private function searchEvalNot($user_id)
    {

        $sql = "
SELECT trade.trade_id,book.book_name,trade.trade_end+INTERVAL 2 DAY,member.member_name,book.book_id FROM trade 
LEFT JOIN evaluation ON trade.trade_id = evaluation.trade_id 
LEFT JOIN book ON trade.book_id = book.book_id 
LEFT JOIN member ON (trade.buyer_id = member.member_id || trade.seller_id = member.member_id ) 
WHERE trade.trade_condition = '評價中' 
AND (trade.buyer_id = '$user_id' OR trade.seller_id = '$user_id') 
AND (evaluation.evaluation_evaluator is NULL OR evaluation.evaluation_evaluator != '$user_id')
AND (member.member_id!='$user_id')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();//array是規定的格式
        $evalData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        foreach ($evalData as $data) {
            $chat[$data['trade_id']] = array(
                'book_name' => $data['book_name'],
                'book_id' => $data['book_id'],
                'member_name' => $data['member_name'],
                'trade_end' => $data['trade.trade_end+INTERVAL 2 DAY']
            );
        }
        echo json_encode($evalData);//用JSON回傳
        $stmt = null;
    }
    
}

?>





