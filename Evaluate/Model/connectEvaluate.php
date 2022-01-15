<?php
/*
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/2
 * Time: 下午 10:23
 */
include("/../../ConnectToDB.php");
class connectEvaluate extends ConnectToDB
{
    private $event = null;
    private $pdo = null;

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
        $buyer = $_SESSION['username'];
        $buyer_id = $_SESSION['userID'];
        $this->getBooks($book_id,$buyer,$buyer_id);
    }

    private function getBooks($book_id,$buyer,$buyer_id)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT `book_id`,`book_name`,`member_name`,book.member_id
                FROM `book` ,`member`
                WHERE book.member_id = member.member_id AND book.book_id=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['book_id']] = array(
                    'book_name' => $data['book_name'],
                    'member_name' => $data['member_name'],
                    'member_id' => $data['member_id']
                );
            }
        }
        $stmt = null;

        //搜尋資料庫資料
        $sql = "SELECT `buyer_id`,`member_name`
                FROM `trade` ,`member`
                WHERE trade.buyer_id = member.member_id AND trade.book_id=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $buyerData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        if ($stmt) {
            foreach ($buyerData as $data) {
                $dataArray[$data['buyer_id']] = array(
                    'buyer_id' => $data['buyer_id'],
                    'buyer_name' => $data['member_name']
                );
            }
        }
        $stmt = null;

        array_push($bookData,$buyerData,$buyer,$buyer_id);

        echo json_encode($bookData);//用$dataArray格式會錯誤
    }
}