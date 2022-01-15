<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/8/9
 * Time: 上午 12:36
 */
class connectAPP extends ConnectToDB
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
        $this->Activate($post["Email"],$post["password"]);
    }

    private function Activate($email,$ps)
    {   //加入暫時會員
        $ps = md5($ps);
        $sql = "INSERT INTO verifynum (vn_id,member_id,vn_number,vn_email,vn_password)
                values (NULL,'0','0','$email','$ps')";
        $stmt = $this->pdo->exec($sql);

        $_SESSION['email'] = $email;
    }
}

?>





