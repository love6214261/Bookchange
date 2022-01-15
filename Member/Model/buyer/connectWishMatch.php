<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectWishMatch extends ConnectToDB
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

        $condition = $post['condition'];

        $this->searchWish($condition);


    }

    private function searchWish($condition)
    {
        switch ($condition) {
            case 'match':
                $this->condition = "wishpool_matchCon = 'match'";
                break;
            case 'unmatch':
                $this->condition = "wishpool_matchCon = 'unmatch'";
                break;

        }


        $sql = "SELECT wishpool_id,wishpool_date,wishpool_bookname,wishpool_author,wishpool_condition 
                 FROM `wishpool`
                  WHERE wishpool.member_id = ? AND ".$this->condition;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['userID']));//array是規定的格式
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($bookData as $data) {
            $dataArray[$data['wishpool_id']] = array(
                'wishpool_date' => $data['wishpool_date'],
                'wishpool_bookname' => $data['wishpool_bookname'],
                'wishpool_author' => $data['wishpool_author'],
                'wishpool_condition' => $data['wishpool_condition'],
                'wishpool_id' => $data['wishpool_id']
            );
        }

        $stmt = null;

        echo json_encode($bookData);//用$dataArray格式會錯誤
    }

}

?>





