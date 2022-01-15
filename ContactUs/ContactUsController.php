<?php

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class ContactUsController extends commonController
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
            case 'ShowContactForm':
                $this->includeAction("ContactUs", "ShowContactForm");
                $actionListener = new ShowContactForm();
                break;
            case 'connectContact':
                $this->includeDB("ContactUs", "connectContact");
                $actionListener = new connectContact($this->event);
                break;
        }
        $actionListener->actionPerformed();
    }
}

$ContactUsController = new ContactUsController();
$ContactUsController->controllerPerformed();
?>