<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectSearchResultPage extends ConnectToDB
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

        $cate = $post['category'];
        $key = $post['keyword'];

        $this->searchBook($cate,$key);



    }
    private function searchBook($cate,$key){
        switch ($cate)
        {
            case 'book_name':
                $this->condition = "book_name Like ?";
                break;
            case 'publishingHouse':
                $this->condition = "book_publishinghouse Like ?";
                break;
            case 'author':
                $this->condition = "book_author Like ?";
                break;
        }


        $sql = "SELECT `book_id`,`book_name`,`book_isbn`,`book_author`,`book_postdate`,`book_price`,`book_publishinghouse`,`book_picture`,`book_twoprice`,book_rentOrNot,member.member_name 
                 FROM `book`,`member`
                  WHERE book.member_id = member.member_id AND book_upcondition = '上架中' AND ".$this->condition;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($key."%"));//array是規定的格式
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
                '2price' => $data['book_twoprice'],
                'rentOrNot' => $data['book_rentOrNot'],
                'member_name' => $data['member_name'],
                'picture' => $data['book_picture']//這邊有trap!!! 取直時要變成data[i]['book_picture']
            );
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤
    }

}

?>





