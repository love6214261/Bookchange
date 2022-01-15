<?php
include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/2
 * Time: 下午 01:24
 */
class loginController extends commonController
{
    private $action = null;

    function __construct()
    {
        parent::__construct();
        $this->action = $this->event->getAction();
    }

    public function controllerPerformed()
    {
        switch ($this->action)
        {
            case 'ShowLoginPage':
                $this->includeAction("AccountActivity", "showLoginPage");
                $actionListener = new showLoginPage();
                break;
            case 'ShowLogoutPage':
                $this->includeAction("AccountActivity", "ShowLogoutPage");
                $actionListener = new ShowLogoutPage();
                break;
            case 'ShowSignUpPage':
                $this->includeAction("AccountActivity", "ShowSignUpPage");
                $actionListener = new ShowSignUpPage();
                break;
            case 'connectAccount':
                $this->includeDB("AccountActivity", "connectAccount");
                $actionListener = new connectAccount($this->event);
                break;
            case 'connectSignup':
                $this->includeDB("AccountActivity", "connectSignup");
                $actionListener = new connectSignup($this->event);
                break;
            case 'connectVerify':
                $this->includeDB("AccountActivity", "connectVerify");
                $actionListener = new connectVerify($this->event);
                break;

        }

        $actionListener->actionPerformed();
    }
}

$loginController = new loginController();
$loginController->controllerPerformed();
?>