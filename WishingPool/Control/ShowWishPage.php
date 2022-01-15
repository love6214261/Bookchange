<?php

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/11
 * Time: 上午 02:39
 */
class ShowWishPage
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
            $this->ShowWishPage();
        }
    }
    public function ShowWishPage()
    {

        header("Refresh: 0; url=../../2HandBookstore/WishingPool/View/wish.html");

    }
    public function ShowLoginPage()
    {

        header("Refresh: 0; url=../../2HandBookstore/AccountActivity/SSO/");

    }
}