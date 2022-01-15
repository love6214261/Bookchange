<?php

/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/2
 * Time: 21:40
 */
class ShowEvaluatePage
{

    public function actionPerformed()
    {
        $this->ShowEvaluatePage();
    }

    public function ShowEvaluatePage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Evaluate/View/evaluate.html");
    }

}

?>