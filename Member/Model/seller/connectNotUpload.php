<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/6
 * Time: 下午 04:45
 */
include("/../../../dbapp.php");


class connectNotUpload extends ConnectToDB
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
        $sql = "SELECT `user`,`isbn`,`coverlink`,`title`,`author`,`publisher`,`ogprice`
                FROM `books_copy` 
                WHERE condition=0 AND user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($seller));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['user']] = array(
                    'user' => $data['user'],
                    'isbn' => $data['isbn'],
                    'coverlink' => $data['coverlink'],
                    'title' => $data['title'],
                    'author' => $data['author'],
                    'publisher' => $data['publisher'],
                    'ogprice' => $data['ogprice']
                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}