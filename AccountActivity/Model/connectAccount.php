<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectAccount extends ConnectToDB
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
        $user = $post['user'];
        $password = $post['password'];
        if ($user == "admin9487") {
            $this->checkADmin($user, $password);
        } else {
            $this->checkAccount($user, $password);
        }
    }

    private function checkAccount($user, $password)
    {
        //搜尋資料庫資料
        $sql = "SELECT * FROM member where member_account = ?AND member_password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($user, $password));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line


        if ($accountData) {
            if ($accountData['member_activated'] == null) {
                ?>
                <script language="javascript">
                    alert("您尚未完成驗證程序!\n完成驗證程序才可進行書籍交易");
                </script>
                <?php
                $_SESSION['user_activatNum'] = 0;
            } else {
                $_SESSION['user_activatNum'] = 1;
            }
            //將帳號寫入session，方便驗證使用者身份
            $_SESSION['userAccount'] = $user;
            $_SESSION['username'] = $accountData['member_name'];
            $_SESSION['userID'] = $accountData['member_id'];
            $_SESSION['user_Score'] = $accountData['member_score'];

            ?>
            <script language="javascript">
                alert("登入成功!");
				window.location.href = '../../2HandBookstore/MainPage/View/index.php';
            </script>

            <script language="javascript">
                window.history.back();
                window.history.back();
            </script>
            <?php
        } else {
            ?>
            <script language="javascript">
                alert("登入失敗! 請重新登入");
            </script>
            <?php
            $dbh = null;
            header("Refresh: 0; url=../../2HandBookstore/AccountActivity/View/login.html");
        }

        $stmt = null;


    }

    private function checkADmin($user, $password)
    {
        //搜尋資料庫資料
        $sql = "SELECT * FROM admin2hand where ad_account = ?AND ad_password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($user, $password));//array是規定的格式
        $accountData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line


        if ($accountData) {
            //將帳號寫入session，方便驗證使用者身份
            $_SESSION['userAccount'] = $user;
            $_SESSION['username'] = $accountData['ad_name'];
            $_SESSION['userID'] = 0;
            $_SESSION['user_Score'] = 0;
            $_SESSION['user_activatNum'] = 1;

            ?>
            <script language="javascript">
                alert("管理員，歡迎您的到來!");
            </script>
            <?php
            header("Refresh: 0; url=../../2HandBookstore/BackStage/index.html");
        } else {
            ?>
            <script language="javascript">
                alert("登入失敗! 請重新登入");
            </script>
            <?php
            $dbh = null;
            header("Refresh: 0; url=../../2HandBookstore/AccountActivity/View/login.html");
        }

        $stmt = null;
    }

}

?>

