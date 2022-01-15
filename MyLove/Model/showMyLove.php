<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class showMyLove extends ConnectToDB
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
        $this->searchMyLove();
    }

    private function searchMyLove()
    {
        $sql="SELECT book.book_name,book.book_twoprice,trace.trace_id,book_picture,book.book_id
			FROM member,trace,book
			WHERE member.member_id = trace.member_id AND trace.book_id = book.book_id AND trace.member_id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['userID']));//array是規定的格式
        $loveData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($loveData as $data) {
            $dataArray[$data['trace_id']] = array(
                'book_name' => $data['book_name'],
                'book_id' => $data['book_id'],
                'price' => $data['book_twoprice'],
                "trace_id"=>$data['trace_id'],
                "book_picture"=>$data['book_picture']
            );
        }
        $stmt = null;
        echo json_encode($loveData);//用$dataArray格式會錯誤
    }

}

?>





