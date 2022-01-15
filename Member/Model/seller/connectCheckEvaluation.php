<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/9
 * Time: 上午 02:36
 */
include("/../../../ConnectToDB.php");


class connectCheckEvaluation extends ConnectToDB
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
        $this->getCheckEvaluation($book_id );
    }

    private function getCheckEvaluation($book_id)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT member_id,buyer_id,seller_id
                FROM trade,evaluation
                WHERE trade.trade_id=evaluation.trade_id AND trade.book_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['member_id']] = array(
                    'member_id' => $data['member_id'],
                    'buyer_id' => $data['buyer_id'],
                    'seller_id' => $data['seller_id']
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}