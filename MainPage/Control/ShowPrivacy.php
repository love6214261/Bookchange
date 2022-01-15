<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowPrivacy
{
    public function actionPerformed()
    {
        $this->ShowPrivacy();
    }

    public function ShowPrivacy()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/privacy.html");
    }

}

?>