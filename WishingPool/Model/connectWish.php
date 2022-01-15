<?php
include("/../../ConnectToDB.php");
//include("/../../Phpmailer/class.phpmailer.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectWish extends ConnectToDB
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

        $bookname = $post['book_name'];
        $userID = $_SESSION['userID'];
        $author = $post['book_author'];
        $ISBN = (int)$post['book_isbn'];
        $PBHouse = $post['book_publishinghouse'];
        $condition = $post['book_condition'];
        $price = (int)$post['book_twoprice'];
        $date = date('Y-m-d H:i:s');

        $this->submit($bookname,$userID, $author, $ISBN, $condition, $price, $PBHouse,$date);

    }

    private function submit($bookname,$userID, $author, $ISBN, $condition, $price, $PBHouse,$date)
    {
        //搜尋資料庫資料
        $sql = "INSERT INTO wishpool(wishpool_id,member_id,wishpool_bookname,wishpool_author,wishpool_isbn,wishpool_condition,wishpool_willingprice,wishpool_publishinghouse,wishpool_date) 
                VALUES (NULL,'$userID','$bookname','$author','$ISBN','$condition','$price','$PBHouse','$date')";
        $stmt = $this->pdo->exec($sql);
        if ($stmt) {
            echo json_encode("success");
            $stmt = null;
        } else {
            echo json_encode("failed");
            $stmt = null;
        }
    }

}

?>

