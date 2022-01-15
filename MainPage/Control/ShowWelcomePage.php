<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowWelcomePage
{
    public function actionPerformed()
    {
        $this->ShowWelcomePage();
    }

    public function ShowWelcomePage()
    {
        header("Refresh: 0; url=../../2HandBookstore/MainPage/View/welcome.html");
    }

}

?>