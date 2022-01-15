<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectAD extends ConnectToDB
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


        $this->chooseAD();


    }

    private function chooseAD()
    {
        //搜尋資料庫資料
        $sql = "SELECT book_picture,book_id FROM book WHERE book_upcondition = '上架中' ORDER BY RAND() LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();//array是規定的格式
        $data = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line


        $ADdata = array(
            "book_picture" => $data['book_picture'],
            "book_id" => $data['book_id']
        );

        $stmt = null;
        echo json_encode($ADdata);


    }

}

?>

