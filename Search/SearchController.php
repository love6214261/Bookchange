<?php
include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/2
 * Time: 下午 01:24
 */
class SearchController extends commonController
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
            case 'connectSearchResultPage':
                $this->includeDB("Search", "connectSearchResultPage");
                $actionListener = new connectSearchResultPage($this->event);
                break;

        }
        $actionListener->actionPerformed();
    }
}

$SearchController = new SearchController();
$SearchController->controllerPerformed();
?>