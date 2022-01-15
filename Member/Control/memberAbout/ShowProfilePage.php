<?php

class ShowProfilePage
{
    public function actionPerformed()
    {
        $this->ShowProfilePage();
    }

    public function ShowProfilePage()
    {
        header("Refresh: 0; url=../../2HandBookstore/Member/View/memberAbout/Profile.html");
    }

}

?>