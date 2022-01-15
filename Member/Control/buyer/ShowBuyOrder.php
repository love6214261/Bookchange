<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 2016/7/20
 * Time: 下午 10:44
 */
class ShowBuyOrder
{
    public function actionPerformed()
    {
        $this->ShowBuyOrder();
    }

    public function ShowBuyOrder()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/buyer/buyorder.html");
    }
}