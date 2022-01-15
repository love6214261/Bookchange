<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectFollowList extends ConnectToDB
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


        $this->searchFollowList();


    }

    private function searchFollowList()
    {

        $sql = "SELECT book.book_id,book_picture,book_name,book_price,book_twoprice,member.member_name,book.book_upcondition,trace.trace_id FROM trace,book,member
                  WHERE trace.member_id = ?
                 AND trace.book_id = book.book_id 
                 AND book.member_id = member.member_id 
                 AND book.book_upcondition = '上架中'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['userID']));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        foreach ($bookData as $data) {
            $dataArray[$data['book_id']] = array(
                'book_picture' => $data['book_picture'],
                'book_name' => $data['book_name'],
                'book_price' => $data['book_price'],
                'book_twoprice' => $data['book_twoprice'],
                'member_name' => $data['member_name'],
                'book_upcondition' => $data['book_upcondition'],
                'book_id' => $data['book_id'],
                'trace_id' => $data['trace_id']

            );
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤
    }

}

?>





