<?php

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class ActivityController extends commonController
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
            /*Created by Peng on 8/4 */
            case 'ShowWelcomePage':
                $this->includeAction("Activity", "ShowWelcomePage");
                $actionListener = new ShowWelcomePage();
                break;
            case 'ShowFreshmanPage':
                $this->includeAction("Activity", "ShowFreshmanPage");
                $actionListener = new ShowFreshmanPage();
                break;
            case 'ShowFreshmanOther':
                $this->includeAction("Activity", "ShowFreshmanOther");
                $actionListener = new ShowFreshmanOther();
                break;
        }
        $actionListener->actionPerformed();
    }
}

$ActivityController = new ActivityController();
$ActivityController->controllerPerformed();
?>