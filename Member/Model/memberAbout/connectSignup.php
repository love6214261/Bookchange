<?php
include("/../../../ConnectToDB.php");
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
            header("Refresh: 0; url=../../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
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

    private function register($account,$password, $name, $school, $department, $email1, $email2,$class)
    {
        $sql = "INSERT INTO member (member_id,member_account,member_password,member_name,member_school,member_department,member_email1,member_email2,member_class,member_activated,member_score,member_tradeNum)
                values (NULL,'$account','$password','$name','$school','$department','$email1','$email2','$class','0','0','0')";
        $stmt = $this->pdo->exec($sql);
        if ($stmt) {
            $this->recordLogin($account,$email2);
            ?>
            <script language="javascript">
                alert("歡迎您加入會員!\n請記得到您的學校信箱收取驗證信!\n中央大學學生請按收POP3外部信");
            </script>
            <?php
            $stmt = null;
            header("Refresh: 0; url=../../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
        } else {
            ?>
            <script language="javascript">
                alert("不好意思><請檢查資料是否錯誤! 或者聯絡管理員");
            </script>
            <?php
            $stmt = null;
            header("Refresh: 0; url=../../../2HandBookstore/MainPage/MainPageController.php?action=ShowMainPage");
        }
    }

    private function recordLogin($account,$email2)
    {
        $sql2 = "SELECT member_id,member_account,member_name,member_email1,member_activated,member_score FROM member where member_account = ?";
        $stmt = $this->pdo->prepare($sql2);
        $stmt->execute(array($account));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userAccount'] = $accountData['member_account'];
        $_SESSION['username'] = $accountData['member_name'];
        $_SESSION['userID'] = $accountData['member_id'];
        $_SESSION['user_activatNum']=$accountData['member_activated'];
        $_SESSION['user_Score']=$accountData['member_score'];

        //信件內容
        $receiver = $accountData['member_name'];
        $receiveMail = $accountData['member_email1'];
        $subject = "親愛的 ".$accountData['member_name']." 您好，開通帳號的時刻到了!";
        $serial = substr(md5(uniqid(rand(), true)),0,10);
        $content = "<br><br>請點選以下連結開通<br>";
        $website="http://localhost/2handBookstore/Member/MemberController.php?action=ShowActivePage";
        $body = $serial.$content.$website;
        $this->event->sendEmail($receiver,$receiveMail,$subject,$body);

        //儲存驗證碼

        $member_id=$accountData['member_id'];

        $sql = "UPDATE verifynum
				SET
				member_id='$member_id',vn_number='$serial'
				WHERE  `vn_email` = '$email2' ";
        $stmt = $this->pdo->exec($sql);
    }
}

?>
