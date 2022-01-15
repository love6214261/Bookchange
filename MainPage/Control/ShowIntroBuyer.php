<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowIntroBuyer
{
    public function actionPerformed()
    {
        $this->ShowIntroBuyer();
    }

    public function ShowIntroBuyer()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/introBuyer.html");
    }

}

?>