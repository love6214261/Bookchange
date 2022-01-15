<?php
/**
 * Created by Peng
 * Date: 2016/8/4
 * Time: 下午 4:44
 */
class ShowActivePage
{
    public function actionPerformed()
    {
        $this->ShowActivePage();
    }

    public function ShowActivePage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/memberAbout/active.html");
    }
    
}

?>