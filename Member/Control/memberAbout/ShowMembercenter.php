<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 2016/7/20
 * Time: 下午 10:44
 */
class ShowMemberCenter
{
    public function actionPerformed()
    {
        if (!isset($_SESSION['username'])) {
            ?>
            <html>
            <script language="javascript">
                alert("請先登入喔!");
            </script>
            </html>
            <?php
            $this->ShowLoginPage();
        }else{
            $this->ShowMemberCenter();
        }
    }
    public function ShowLoginPage()
    {

        header("Refresh: 0; url=../../2HandBookstore/AccountActivity/SSO/");

    }
    public function ShowMemberCenter()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/memberAbout/MemberCenter.html");
    }
}