<?php

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class MyLoveController extends commonController
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
            case 'connectMyLove':
                $this->includeDB("MyLove", "connectMyLove");
                $actionListener = new connectMyLove($this->event);
                break;
            case 'removeMyLove':
                $this->includeDB("MyLove", "removeMyLove");
                $actionListener = new removeMyLove($this->event);
                break;
            case 'removeWish':
                $this->includeDB("MyLove", "removeWish");
                $actionListener = new removeWish($this->event);
                break;
            case 'showMyLove':
                $this->includeDB("MyLove", "showMyLove");
                $actionListener = new showMyLove($this->event);
                break;
        }
        $actionListener->actionPerformed();
    }
}

$MyLoveController = new MyLoveController();
$MyLoveController->controllerPerformed();
?>