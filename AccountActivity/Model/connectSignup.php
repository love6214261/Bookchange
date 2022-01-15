<?php
include("/../../ConnectToDB.php");
//include("/../../Phpmailer/class.phpmailer.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectSignup extends ConnectToDB
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
        $password = $post['password'];
        $name = $post['name'];
        $school = $post['school'];
        $department = $post['department'];
        $email1 = $post['email1'];
        $email2 = $post['email2'];
        
        $class = $post['class'];

        if ($this->chkIfAccountExist($account) == true) {
            $this->register($account, $password, $name, $school, $department, $email1, $email2,$class);
        } else {
            header("Refresh: 0; url=../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
        }


    }

    private function chkIfAccountExist($account)
    {
        $sql = "SELECT member_account FROM member where member_account = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($account));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line

        if ($accountData['member_account'] == $account) {
            $stmt = null;
            ?>
            <script language="javascript">
                alert("此帳號已有人使用囉!\n如有問題請洽管理員!");
            </script>
            <?php
            $stmt = null;
            return false;
        } else {
            $stmt = null;
            return true;
        }


    }

    private function register($account, $password, $name, $school, $department, $email1, $email2,$class)
    {
        //搜尋資料庫資料
        $password = md5($password);
        $sql = "INSERT INTO member (member_id,member_account,member_password,member_name,member_school,member_department,member_email1,member_email2,member_class,member_activated,member_score,member_tradeNum)
                values (NULL,'$account','$password','$name','$school','$department','$email1','$email2','$class','0','0','0')";
        $stmt = $this->pdo->exec($sql);
        if ($stmt) {
            $this->recordLogin($account);
            ?>
            <script language="javascript">
                alert("歡迎您加入會員!請記得到您的學校信箱收取驗證信!");
            </script>
            <?php
            $stmt = null;
            header("Refresh: 0; url=../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
        } else {
            ?>
            <script language="javascript">
                alert("不好意思><請檢查資料是否錯誤! 或者聯絡管理員");
            </script>
            <?php
            $stmt = null;
            header("Refresh: 0; url=../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
        }
    }

    private function sendEmail($receive,$receiveMail)
    {
        $header = "台灣囝仔會員驗證信";
        $body =  "http://localhost/2handBookstore/AccountActivity/loginController.php?action=connectVerify";
        $this->event->sendEmail($receive,$receiveMail,$header,$body);//寄信
    }

    private function recordLogin($account)
    {
        $sql2 = "SELECT member_id,member_account,member_name,member_email1 FROM member where member_account = ?";
        $stmt = $this->pdo->prepare($sql2);
        $stmt->execute(array($account));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userAccount'] = $accountData['member_account'];
        $_SESSION['username'] = $accountData['member_name'];
        $_SESSION['userID'] = $accountData['member_id'];

        $this->sendEmail($accountData['member_name'],$accountData['member_email1']);//寄信
    }
}

?>
