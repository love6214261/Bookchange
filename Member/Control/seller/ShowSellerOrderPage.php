<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/9
 * Time: 上午 02:18
 */
class ShowSellerOrderPage
{
    public function actionPerformed()
    {
        $this->ShowSellerOrderPage();
    }

    public function ShowSellerOrderPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/seller/sellorder.html");
    }
}