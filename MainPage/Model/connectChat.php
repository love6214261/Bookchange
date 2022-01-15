<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectChat extends ConnectToDB
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
switch ($post['do']){
    case 'content':
        $this->searchChat($user_id);
        break;
    case 'Num':
        $this->searchChatNum($user_id);
        break;
}

    }

    private function searchChat($user_id)
    {
        $sql = "SELECT MAX(chat_id),book.book_picture,book.book_name,chat.chat_content,member.member_name,book.book_id 
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND (trade.seller_id = '$user_id' ||  trade.buyer_id = '$user_id')
AND chat.member_id != '$user_id'
AND (chat.chat_sellerRead = ? ||chat.chat_buyerRead = ? )
GROUP BY chat.book_id
";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0,0));//array是規定的格式
        $chatData = $stmt->fetchAll(PDO::FETCH_ASSOC); // key point  line

        foreach ($chatData as $data) {
            $chat[$data['MAX(chat_id)']] = array(
                'book_name' => $data['book_name'],
                'book_picture' => $data['book_picture'],
                'book_id' => $data['book_id'],
                'chat_content' => $data['chat_content'],
                'member_name' => $data['member_name']
            );
        }
        echo json_encode($chatData);//用JSON回傳
        $stmt = null;
    }
    private function searchChatNum($user_id)
    {
        $sql = "SELECT MAX(chat_id),book.book_picture,book.book_name,chat.chat_content,member.member_name,book.book_id 
FROM chat,trade,book,member 
WHERE chat.book_id = trade.book_id 
AND chat.member_id = member.member_id 
AND trade.book_id = book.book_id
AND (trade.seller_id = '$user_id' ||  trade.buyer_id = '$user_id')
AND chat.member_id != '$user_id'
AND (chat.chat_sellerRead = ? ||chat.chat_buyerRead = ? )
GROUP BY chat.book_id
";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array(0,0));//array是規定的格式
        $chatNum = $stmt->rowCount(PDO::FETCH_NUM); // key point  line
        echo json_encode($chatNum);//用JSON回傳
        $stmt = null;
    }
}

?>





