<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/10
 * Time: 下午 09:11
 */
class connectChatCheckID extends ConnectToDB
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
        $book_id = $post['book_id'];


        $this->getBooks($book_id);

    }

    private function getBooks($book_id)
    {
        $sql = "";
        $user = $_SESSION['userID'];
        //搜尋資料庫資料
        $sql = "SELECT trade.buyer_id,trade.seller_id 
FROM `trade` 
WHERE (trade.buyer_id= '$user' ||trade.seller_id= '$user') AND trade.book_id = ? ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $Data = $stmt->FETCH(PDO::FETCH_ASSOC); // key point  line

        if ($user == $Data['buyer_id']) {
            $sql = "UPDATE chat SET chat.chat_buyerRead = 1 WHERE chat.book_id = '$book_id' AND chat.chat_buyerRead = 0";
            $this->pdo->exec($sql);
            echo json_encode("buyer");
        } else {
            $sql = "UPDATE chat SET chat.chat_sellerRead = 1 WHERE chat.book_id = '$book_id'  AND chat.chat_sellerRead = 0";
            $this->pdo->exec($sql);
            echo json_encode("seller");
        }

        $stmt = null;
    }
}



