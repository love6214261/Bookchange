<?php
include("/../../dbtest.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/10
 * Time: 下午 09:11
 */
class connectSearchBookDB extends ConnectToDB
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
        $bookISBN = $post['bookISBN'];
        $this->getBooks($bookISBN);
    }

    private function getBooks($bookISBN)
    {
        $sql = "";


        //搜尋資料庫資料
        //搜尋資料庫資料
        $sql = "SELECT isbn,author,publisher,title,price,coverlink
                FROM books
                WHERE isbn = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($bookISBN));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line

        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['isbn']] = array(
                    'isbn' => $data['isbn'],
                    'author' => $data['author'],
                    'publisher' => $data['publisher'],
                    'title' => $data['title'],
                    'price' => $data['price'],
                    'coverlink' => $data['coverlink']

                );
            }
        }
        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}