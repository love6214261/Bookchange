<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectMemberPage extends ConnectToDB
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
        $member_id = $post['member_id'];
        $this->getProfile($member_id);
    }

    private function getProfile($member_id)
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "SELECT member_id,member_name,member_school,member_department,member_score FROM member
                WHERE member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($member_id));//array是規定的格式
        $data = $stmt->FETCH(PDO::FETCH_ASSOC); // key point  line



            $dataArray = array(
                "member_id" => $data['member_id'],
                "member_name" => $data['member_name'],
                "member_school" => $data['member_school'],
                "member_department" => $data['member_department'],
                "member_score" => $data['member_score']
            );


        $stmt = null;

        echo json_encode( $dataArray);//用$dataArray格式會錯誤

    }
}