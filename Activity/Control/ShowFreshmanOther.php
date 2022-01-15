<?php
/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/4
 * Time: 下午 04:31
 */
class ShowFreshmanOther
{
    public function actionPerformed()
    {
        $this->ShowFreshmanOther();
    }

    public function ShowFreshmanOther()
    {
        header("Refresh: 0; url=../../2HandBookstore/Activity/View/freshman_other.html");
    }

}

?>