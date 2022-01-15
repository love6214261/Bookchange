<?php
include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Johnathon Peng
 * Date: 2016/8/2
 * Time: 21:38
 */
class EvaluateController extends commonController
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
            case 'ShowEvaluate':
                $this->includeAction("Evaluate", "ShowEvaluatePage");
                $actionListener = new ShowEvaluatePage();
                break;

            case 'connectEvaluate':
                $this->includeDB("Evaluate", "connectEvaluate");
                $actionListener = new connectEvaluate($this->event);
                break;

            case 'connectUploadEvaluate':
                $this->includeDB("Evaluate", "connectUploadEvaluate");
                $actionListener = new connectUploadEvaluate($this->event);
                break;

        }

        $actionListener->actionPerformed();
    }
}

$EvaluateController = new EvaluateController();
$EvaluateController->controllerPerformed();
?>