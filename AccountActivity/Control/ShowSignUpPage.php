<?php

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/2
 * Time: 下午 01:52
 */
class ShowSignUpPage
{
    public function actionPerformed()
    {
        $this->ShowSignUpPage();
    }

    public function ShowSignUpPage()
    {
        header("Refresh: 0; url=../../2HandBookstore/AccountActivity/View/signup.html");
    }

}

?>