<?php
include "../commonController.php";
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/16
 * Time: 上午 12:22
 */
class OtherBookController extends commonController
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
            case 'connectOtherBook':
                $this->includeDB("BookManagement", "connectOtherBook");
                $actionListener = new connectOtherBook($this->event);
                break;
            case 'connectSearchBookDB':
                $this->includeDB("BookManagement", "connectSearchBookDB");
                $actionListener = new connectSearchBookDB($this->event);
                break;
            
        }
        $actionListener->actionPerformed();
    }
}

$OtherBookController = new OtherBookController();
$OtherBookController->controllerPerformed();
?>