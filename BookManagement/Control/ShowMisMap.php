<?php
/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/4
 * Time: 下午 04:31
 */
class ShowMisMap
{
    public function actionPerformed()
    {
        $this->ShowMisMap();
    }

    public function ShowMisMap()
    {
        header("Refresh: 0; url=../../2HandBookstore/BookManagement/View/mismap.html");
    }

}

?>