<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowIntroRent
{
    public function actionPerformed()
    {
        $this->ShowIntroRent();
    }

    public function ShowIntroRent()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/introRent.html");
    }

}

?>