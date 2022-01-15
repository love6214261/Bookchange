<?php

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/9
 * Time: 上午 02:50
 */
class ShowPoolPage
{
    public function actionPerformed()
    {
        $this->ShowPoolPage();
    }

    public function ShowPoolPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/WishingPool/View/pool.html");
    }
}