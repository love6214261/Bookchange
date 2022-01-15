<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectMyLove extends ConnectToDB
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

        $page = $post['page'];

        $this->addMyLove($page);
        echo json_encode("success");

    }

    private function addMyLove($page)
    {
        $id_buyer = $_SESSION['userID'];
        $sql = "INSERT INTO trace (trace_id,member_id,book_id) values (NULL,' $id_buyer','$page')";
        $stmt = $this->pdo->exec($sql);

        if ($stmt) {  }
        $stmt = null;
    }

}

?>





