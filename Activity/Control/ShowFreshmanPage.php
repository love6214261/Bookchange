<?php
/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/4
 * Time: 下午 04:31
 */
class ShowFreshmanPage
{
    public function actionPerformed()
    {
        $this->ShowFreshmanPage();
    }

    public function ShowFreshmanPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Activity/View/freshman_center.html");
    }

}

?>