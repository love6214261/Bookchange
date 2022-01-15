<?php
/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/4
 * Time: 下午 04:31
 */
class ShowTradeRule
{
    public function actionPerformed()
    {
        $this->ShowTradeRule();
    }

    public function ShowTradeRule()
    {
        header("Refresh: 0; url=../../2HandBookstore/BookManagement/View/tradeRule.html");
    }

}

?>