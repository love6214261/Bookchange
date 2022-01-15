<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/10
 * Time: 下午 09:11
 */
class connectChatDB extends ConnectToDB
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
        $buyer = $_SESSION['userID'];

        $this->getBooks($book_id, $buyer);

    }

    private function getBooks($book_id, $buyer)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT `chat_time`,`chat_content`,member.member_name,chat_id
                FROM `chat`, `member`
                WHERE chat.member_id= member.member_id AND chat.book_id = ?
                ORDER BY chat_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['chat_id']] = array(
                    'chat_time' => $data['chat_time'],
                    'chat_content' => $data['chat_content'],
                    'member_name' => $data['member_name']
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}



