<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class removeMyLove extends ConnectToDB
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

        $traceID = $post['traceID'];

        $this->addMyLove($traceID);


    }

    private function addMyLove($traceID)
    {
        $sql = "DELETE FROM trace WHERE trace_id = '$traceID'";
        $stmt = $this->pdo->exec($sql);
        if ($stmt) {
            echo json_encode("success");
        } else {
            echo json_encode("Fail");
        }
        $stmt = null;
    }

}

?>





