<?php

/**
 * Created by PhpStorm.
 * User: Peng
 * Date: 2016/7/27
 * Time: 下午 9:48
 */
class ShowChangePassword
{
    public function actionPerformed()
    {
        $this->ShowChangePassword();
    }

    public function ShowChangePassword()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/memberAbout/ChangePwd.html");
    }
}