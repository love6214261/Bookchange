<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/8/9
 * Time: 上午 12:36
 */
class connectEmail extends ConnectToDB
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
        $this->Activate();
    }

    private function Activate()
    {
        $sql = "SELECT vn_password FROM verifynum where vn_email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($_SESSION['email']));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line

        echo json_encode(array("email"=>$_SESSION['email'],"password"=>$accountData["vn_password"]));
    }
}

?>





