<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/17
 * Time: 下午 08:59
 */
include("/../../../ConnectToDB.php");


class connectTrading extends ConnectToDB
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
        $seller = $_SESSION['userID'];
        $this->getOnsaleBooks($seller);
    }

    private function getOnsaleBooks($seller)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT book.book_id,`book_picture`,`book_name`,`book_author`,`book_twoprice`,`book_upcondition`,`trade_end`,`member_name`
                FROM `book` ,`trade` , `member`
                WHERE book.book_id=trade.book_id AND member.member_id = trade.buyer_id AND book.member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($seller));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['book_id']] = array(
                    'book_id' => $data['book_id'],
                    'book_picture' => $data['book_picture'],
                    'book_name' => $data['book_name'],
                    'book_author' => $data['book_author'],
                    'book_twoprice' => $data['book_twoprice'],
                    'book_upcondition' => $data['book_upcondition'],
                    'trade_end' => $data['trade_end'],
                    'member_name' => $data['member_name']
                    
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}