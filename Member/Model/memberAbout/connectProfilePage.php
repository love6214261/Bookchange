<?php
include("/../../../ConnectToDB.php");
/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectProfilePage extends ConnectToDB
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
        $this->searchProfile($_SESSION['userID']);
    }
    private function searchProfile($userID){
        $sql = "SELECT * FROM member where member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($userID));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line

        $account = $accountData['member_account'];
        $name = $accountData['member_name'];
        $school = $accountData['member_school'];
        $department = $accountData['member_department'];
        $email_1 = $accountData['member_email1'];
        $email_2 = $accountData['member_email2'];

        $profileArray = array(
            "account" => $account,
            "name" => $name,
            "school" => $school,
            "department" => $department,
            "email1" => $email_1,
            "email2" => $email_2
        );

        $stmt = null;
        echo json_encode($profileArray);//用JSON回傳
    }
}

?>





