<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/10
 * Time: 下午 09:11
 */
class connectWaitChoice extends ConnectToDB
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
        $book_id= $post['book_id'];
        $this->getWaitChoice($book_id);
    }

    private function getWaitChoice($book_id)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT book_name,waitlist.member_id,member_name,member_score,waitlist_RorB
                FROM book,waitlist,member
                WHERE book.book_id=waitlist.book_id AND waitlist.member_id=member.member_id AND waitlist.book_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['member_id']] = array(
                    'book_name' => $data['book_name'],
                    'member_id' => $data['member_id'],
                    'member_name' => $data['member_name'],
                    'member_score' => $data['member_score'],
                    'waitlist_RorB' => $data['waitlist_RorB'],
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}