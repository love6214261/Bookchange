<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowIntroSeller
{
    public function actionPerformed()
    {
        $this->ShowIntroSeller();
    }

    public function ShowIntroSeller()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/introSeller.html");
    }

}

?>