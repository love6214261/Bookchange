<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/16
 * Time: 下午 11:36
 */
class connectVerify extends ConnectToDB
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
        $this->Activate($_SESSION['userAccount']);
    }

    private function Activate($account)
    {
        $sql = "UPDATE member
				SET
				`member_activated` = '1'
				WHERE  `member_account` = '$account' ";
        $stmt = $this->pdo->exec($sql);

        if ($stmt) {
            ?>
            <script language="javascript">
                alert("認證完成，歡迎登入使用!!");
            </script>
            <?php
            header("Refresh: 0; url=../../2HandBookstore/index.php");
        } else {
            if(!isset($_SESSION['userID'])) {
                ?>
                <script language="javascript">
                    alert("您已認證，歡迎登入使用!");
                </script>
                <?php
                header("Refresh: 0; url=../../2HandBookstore/MainPage/MainPageController.php?action=ShowWelcomePage");
            }else{
                ?>
                <script language="javascript">
                    alert("您已認證過，歡迎繼續使用!");
                </script>
                <?php
                header("Refresh: 0; url=../../2HandBookstore/MainPage/MainPageController.php?action=ShowWelcomePage");
                //header("Refresh: 0; url=../../2HandBookstore/index.php");
            }
        }
        $stmt = null;

    }
}

?>





