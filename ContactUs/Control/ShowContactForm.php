<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/12
 * Time: 下午 04:57
 */
class ShowContactForm
{
    public function actionPerformed()
    {
        $this->ShowContactForm();
    }

    public function ShowContactForm()
    {
        header("Refresh: 0; url=../../2HandBookstore/ContactUs/View/contactUs.html");
    }

}

?>