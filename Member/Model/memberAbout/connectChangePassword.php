<?php
include("/../../../ConnectToDB.php");
/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/8/9
 * Time: 上午 12:36
 */
class connectChangePassword extends ConnectToDB
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
        $this->searchTrace();
    }

    private function searchTrace()
    {
        $sql = "SELECT * FROM trace WHERE trace_sellerRead = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array("unread"));//array是規定的格式
        $traceNum = $stmt->rowCount(PDO::FETCH_NUM); // key point  line

        echo json_encode($traceNum);//用JSON回傳
        $stmt = null;
    }
}

?>





