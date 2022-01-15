<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectProfileModified extends ConnectToDB
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
        $account = $post['account'];
        $name = $post['name'];
        $school = $post['school'];
        $department = $post['department'];
        $email_1 = $post['email_1'];
        $email_2 = $post['email_2'];
        if($account == null || $name == null || $school == null){
            ?>
            <script language="javascript">
                alert("還沒修改，請檢查所有欄位是否填對!");
                window.history.back();
            </script>
            <?php
        }else{
            $this->modifyProfile($account, $name, $school, $department, $email_1, $email_2);
        }

    }

    private function modifyProfile($account,$name, $school, $department, $email_1, $email_2)
    {
        $sql = "UPDATE member
				SET
				`member_name` = '$name',
				`member_school` = '$school',`member_department` = '$department',
				`member_email1` = '$email_1',`member_email2` = '$email_2'
				WHERE  `member_account` = '$account' ";
        $stmt = $this->pdo->exec($sql);

        if ($stmt) {
            $_SESSION['username']=$name;
            $stmt = null;
            ?>
            <script language="javascript">
                alert("修改了啦!");
                window.history.back();
            </script>
            <?php


        } else {
            $stmt = null;
            ?>
            <script language="javascript">
                alert("還沒修改，請檢查所有欄位是否填對!");
                window.history.back();
            </script>
            <?php
        }
    }
}

?>





