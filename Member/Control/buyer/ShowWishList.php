<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 2016/7/20
 * Time: 下午 10:43
 */
class ShowWishList
{
    public function actionPerformed()
    {
        $this->ShowWishList();
    }

    public function ShowWishList()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/buyer/wantlist.html");
    }
}