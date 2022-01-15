<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectBookInfo extends ConnectToDB
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
        $this->getBooks($book_id);
    }

    private function getBooks($book_id)
    {
        $sql = "";

        //搜尋資料庫資料
        $sql = "SELECT `book_id`,`book_name`,`book_isbn`,`book_author`,`book_postdate`,`book_price`,
                        `book_publishinghouse`,`book_picture`,`book_twoprice`,book_class,book_upcondition,book_rentOrNot,
                        member.member_name,member.member_id,member.member_score,member_tradeNum
        FROM `book`,`member` 
        WHERE book.member_id = member.member_id AND book_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($book_id));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        if ($stmt) {
            foreach ($bookData as $data) {
                $dataArray[$data['book_id']] = array(
                    'id_book' => $data['book_id'],
                    'book_name' => $data['book_name'],
                    'ISBN' => $data['book_isbn'],
                    'author' => $data['book_author'],
                    'postdate' => $data['book_postdate'],
                    'price' => $data['book_price'],
                    'publishingHouse' => $data['book_publishinghouse'],
                    'picture' => $data['book_picture'],
                    '2price' => $data['book_twoprice'],
                    'class' => $data['book_class'],
//                    'member_profile' => $data['member_profile'],
                    'member_name' => $data['member_name'],
                    'member_id' => $data['member_id'],
                    'book_upcondition' => $data['book_upcondition'],
                    'member_score' => $data['member_score'],
                    'member_tradeNum' => $data['member_tradeNum'],
                    'book_rentOrNot' => $data['book_rentOrNot']
                );
            }
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}