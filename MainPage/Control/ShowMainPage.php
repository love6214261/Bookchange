<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowMainPage
{
    public function actionPerformed()
    {
        $this->ShowMainPage();
    }

    public function ShowMainPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/index.php");
    }

}

?>