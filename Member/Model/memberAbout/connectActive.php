<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/8/9
 * Time: 上午 12:36
 */
class connectActive extends ConnectToDB
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
        $num = $post['num'];
        $this->Activate($num);
    }

    private function Activate($num)
    {
        $account = $_SESSION['userID'];
        //驗證碼是否正確
        $sql2 = "SELECT vn_number 
                      FROM member,verifynum
                        where member.member_id = verifynum.member_id AND verifynum.member_id = ?";
        $stmt = $this->pdo->prepare($sql2);
        $stmt->execute(array($account));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($num == $accountData['vn_number']) {
            $sql = "UPDATE member
				SET
				`member_activated` = '1'
				WHERE  `member_id` = '$account' ";
            $stmt = $this->pdo->exec($sql);
            echo json_encode("success");
        } else {
            echo json_encode("failed");
        }
    }
}

?>





