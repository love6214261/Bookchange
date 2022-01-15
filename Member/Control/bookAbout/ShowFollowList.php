<?php
/**
 * Created by Peng
 * Date: 2016/7/20
 * Time: 下午 10:44
 */
class ShowFollowList
{
    public function actionPerformed()
    {
        if (!isset($_SESSION['username'])) {
            ?>
            <script language="javascript">
                alert("請先登入喔!");
            </script>
            <?php
            $this->ShowLoginPage();
        } else {
            $this->ShowFollowList();
        }
    }

    public function ShowFollowList()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/bookAbout/followlist.html");
    }

    public function ShowLoginPage()
    {

        header("Refresh: 0; url=../../2HandBookstore/AccountActivity/SSO/index.php");

    }
}

?>