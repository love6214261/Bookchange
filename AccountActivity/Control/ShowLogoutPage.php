<?php

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/14
 * Time: 下午 09:45
 */
class ShowLogoutPage
{
    public function actionPerformed()
    {
        $this->ShowLogoutPage();
    }

    public function ShowLogoutPage()
    {
 
            unset($_SESSION['username']);
            unset($_SESSION["userID"]);
            unset($_SESSION["userAccount"]);
            unset($_SESSION['ser_activatNum']);
            unset($_SESSION['user_Score']);
            header("Refresh: 0; url=../MainPage/MainPageController.php?action=ShowMainPage");


    }
}

?>