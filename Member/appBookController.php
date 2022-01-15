<?php
include "../commonController.php";
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/16
 * Time: 上午 12:22
 */
class appBookController extends commonController
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

            case 'connectNotUpload':
                $this->includeDB("Member", "seller/connectNotUpload");
                $actionListener = connectNotUpload($this->event);
                break;

        }
        $actionListener->actionPerformed();
    }
}

$appBookController = new appBookController();
$appBookController->controllerPerformed();
?>