<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectBookPage extends ConnectToDB
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
        $page = $post['page'];
        $num=$post['num'];
        if($num==0){
            echo '已經是第一頁!';
        }
        else {
            $this->getBooks($page, $num);
        }
    }

    private function getBooks($page, $num)
    {
        $sql = "";

        $p=$num*10-10;

        //搜尋資料庫資料
        $sql = "SELECT `book_id`,`book_name`,`book_isbn`,`book_author`,`book_postdate`,`book_price`,`book_publishinghouse`,`book_picture`,`book_twoprice`,book_rentOrNot,member.member_name,book_upcondition 
                 FROM `book`,`member` 
                WHERE book.member_id = member.member_id AND book_class = ? AND book_upcondition='上架中'
                LIMIT $p,10
                ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($page));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($bookData as $data) {
            $dataArray[$data['book_id']] = array(
                'id_book' => $data['book_id'],
                'book_name' => $data['book_name'],
                'ISBN' => $data['book_isbn'],
                'author' => $data['book_author'],
                'postdate' => $data['book_postdate'],
                'price' => $data['book_price'],
                'publishingHouse' => $data['book_publishinghouse'],
                'picture' => $data['book_picture'],//這邊有trap!!! 取直時要變成data[i]['book_picture']
                '2price' => $data['book_twoprice'],
                'rentOrNot' => $data['book_rentOrNot'],
                'member_name' => $data['member_name'],
                'book_upcondition' => $data['book_upcondition'],
            );
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}