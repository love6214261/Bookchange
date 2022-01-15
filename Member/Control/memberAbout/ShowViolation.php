<?php
/**
 * Created by Peng
 * Date: 2016/8/4
 * Time: 下午 4:44
 */
class ShowViolation
{
    public function actionPerformed()
    {
        $this->ShowViolation();
    }

    public function ShowViolation()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/violation.html");
    }
    
}

?>