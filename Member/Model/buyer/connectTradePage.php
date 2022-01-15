<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectTradePage extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = null;
    private $conditionPara = array();

    function __construct($event)
    {
        parent::__construct();
        $this->event = $event;
        $this->pdo = $this->getPDO();
    }

    public function actionPerformed()
    {
        $post = $this->event->getPost();

        $condition = $post['condition'];

        $this->searchTrade($condition);


    }

    private function searchTrade($condition)
    {
        switch ($condition) {
            case 'trading':
                $this->condition = "trade.trade_condition = '交易中'";
                break;
            case 'evaluating':
                $this->condition = "trade.trade_condition = '評價中'";
                break;
            case 'tradeSuccess':
                $this->condition = "trade.trade_condition = '交易成功'";
                break;
            case 'tradeFailed':
                $this->condition = "trade.trade_condition = '交易失敗'";
                break;

        }


        $sql = "SELECT book.book_id,book_picture,book_name,book_author,book_twoprice,trade_id,trade_end,member_name
                 FROM trade,book,member
                  WHERE trade.book_id = book.book_id AND member.member_id = trade.seller_id AND trade.buyer_id = ? AND ".$this->condition;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['userID']));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($bookData as $data) {
            $dataArray[$data['trade_id']] = array(
                'book_id' => $data['book_id'],
                'book_picture' => $data['book_picture'],
                'book_name' => $data['book_name'],
                'book_author' => $data['book_author'],
                'book_twoprice' => $data['book_twoprice'],
                'trade_end' => $data['trade_end'],
                'member_name' => $data['member_name']
            );
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤
    }

}

?>





