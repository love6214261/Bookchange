<?php

/**
 * Created by PhpStorm.
 * User: Allen Hsu
 * Date: 2016/7/7
 * Time: 下午 04:29
 */
class ShowUploadBookPage
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
            $this->ShowUploadBookPage();
        }
    }

    public function ShowUploadBookPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/BookManagement/View/upload.html");
    }

    public function ShowLoginPage()
    {

        header("Refresh: 0; url=../../2HandBookstore/AccountActivity/SSO/index.php");

    }

}

?>