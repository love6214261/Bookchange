<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectMemberPageEval extends ConnectToDB
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
        $sql = "SELECT evaluation_id,evaluation_score,evaluation_date,evaluation_advise,trade_condition
                FROM evaluation,trade
                WHERE evaluation.trade_id = trade.trade_id AND member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($member_id));//array是規定的格式
        $evalData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($evalData as $data) {
            $dataArray[$data['evaluation_id']] = array(
                "evaluation_score" => $data['evaluation_score'],
                "evaluation_date" => $data['evaluation_date'],
                "evaluation_advise" => $data['evaluation_advise'],
                "trade_condition" => $data['trade_condition']
            );
        }


        $stmt = null;

        echo json_encode($evalData);//用$dataArray格式會錯誤

    }
}