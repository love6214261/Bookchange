<?php

include "../commonController.php";
class PublicPageController  extends commonController{

    private $action = null;

    function __construct() {
        parent::__construct();
        $this->action = $this->event->getAction();

    }

    public function controllerPerformed() {
        switch ($this->action) {
            case 'ShowMemberPage':
                $this->includeAction("PublicPage","ShowMemberPage");
                $actionListener = new ShowMemberPage();
                break;
            case 'connectMemberPage':
                $this->includeDB("PublicPage", "connectMemberPage");
                $actionListener = new connectMemberPage($this->event);
                break;
            case 'connectMemberPageEval':
                $this->includeDB("PublicPage", "connectMemberPageEval");
                $actionListener = new connectMemberPageEval($this->event);
                break;

        }

        $actionListener->actionPerformed();

    }

}

$PublicPageController  = new PublicPageController ();
$PublicPageController ->controllerPerformed();

?>