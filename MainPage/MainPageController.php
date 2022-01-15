<?php

include_once "../commonController.php";

class MainController extends commonController
{

    private $action = null;

    function __construct()
    {
        parent::__construct();
        $this->action = $this->event->getAction();

    }

    public function controllerPerformed()
    {
        switch ($this->action) {
            case 'ShowMainPage':
                $this->includeAction("MainPage", "ShowMainPage");
                $actionListener = new ShowMainPage();
                break;
            case 'ShowUserLaw':
                $this->includeAction("MainPage", "ShowUserLaw");
                $actionListener = new ShowUserLaw();
                break;
            case 'ShowPrivacy':
                $this->includeAction("MainPage", "ShowPrivacy");
                $actionListener = new ShowPrivacy();
                break;
            case 'ShowIntroBuyer':
                $this->includeAction("MainPage", "ShowIntroBuyer");
                $actionListener = new ShowIntroBuyer();
                break;
            case 'ShowIntroSeller':
                $this->includeAction("MainPage", "ShowIntroSeller");
                $actionListener = new ShowIntroSeller();
                break;
            case 'ShowIntroRent':
                $this->includeAction("MainPage", "ShowIntroRent");
                $actionListener = new ShowIntroRent();
                break;
            case 'ShowWelcomePage':
                $this->includeAction("MainPage", "ShowWelcomePage");
                $actionListener = new ShowWelcomePage();
                break;
            case 'connectAD':
                $this->includeDB("MainPage", "connectAD");
                $actionListener = new connectAD($this->event);
                break;
            case 'connectChat':
                $this->includeDB("MainPage","connectChat");
                $actionListener = new connectChat($this->event);
                break;


        }

        $actionListener->actionPerformed();

    }

}

$MainController = new MainController();
$MainController->controllerPerformed();

?>