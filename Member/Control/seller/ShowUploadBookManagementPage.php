<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/6
 * Time: 下午 04:21
 */
class ShowUploadBookManagementPage
{
    public function actionPerformed()
    {
        $this->ShowUploadBookManagementPage();
    }

    public function ShowUploadBookManagementPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/seller/book_management.html");
    }
}