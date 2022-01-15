<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/6
 * Time: 下午 04:45
 */
include("/../../../ConnectToDB.php");


class connectShowUploadBook extends ConnectToDB
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
        $this->getUploadBooks($seller);
    }

    private function getUploadBooks($seller)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT `book_id`,`book_time`,`book_picture`,`book_name`,`book_author`,`book_publishinghouse`,`book_class`,`book_twoprice`,`book_upcondition`
                FROM `book` 
                WHERE member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($seller));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['book_id']] = array(
                    'book_id' => $data['book_id'],
                    'book_time' => $data['book_time'],
                    'book_picture' => $data['book_picture'],
                    'book_name' => $data['book_name'],
                    'book_author' => $data['book_author'],
                    'book_publishinghouse' => $data['book_publishinghouse'],
                    'book_class' => $data['book_class'],
                    'book_twoprice' => $data['book_twoprice'],
                    'book_upcondition' => $data['book_upcondition']//這邊有trap!!! 取直時要變成data[i]['book_picture']
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}