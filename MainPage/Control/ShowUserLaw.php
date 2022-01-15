<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowUserLaw
{
    public function actionPerformed()
    {
        $this->ShowUserLaw();
    }

    public function ShowUserLaw()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/userlaw.html");
    }

}

?>