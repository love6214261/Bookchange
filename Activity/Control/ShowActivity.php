<?php
/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/4
 * Time: 下午 04:31
 */
class ShowActivity
{
    public function actionPerformed()
    {
        $this->ShowActivity();
    }

    public function ShowActivity()
    {
        header("Refresh: 0; url=../../2HandBookstore/Activity/View/event.html");
    }

}

?>