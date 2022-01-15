<?php

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/10
 * Time: 上午 12:04
 */
class ShowBookInfoPage
{

    public function actionPerformed()
    {
        $this->ShowBookInfoPage();
    }

    public function ShowBookInfoPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/BookManagement/View/bookInfo.html");
    }

}

?>