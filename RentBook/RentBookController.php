<?php

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class RentBookController extends commonController
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
            case 'connectRentBook':
                $this->includeDB("RentBook", "connectRentBook");
                $actionListener = new connectRentBook($this->event);
                break;
            case 'ifAddedInRentlist':
                $this->includeDB("RentBook", "ifAddedInRentlist");
                $actionListener = new ifAddedInRentlist($this->event);
                break;
        }
        $actionListener->actionPerformed();
    }
}

$RentBookController = new RentBookController();
$RentBookController->controllerPerformed();
?>