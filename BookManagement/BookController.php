<?php

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class BookController extends commonController
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
            case 'ShowBookInfoPage':
                $this->includeAction("BookManagement", "ShowBookInfoPage");
                $actionListener = new ShowBookInfoPage();
                break;
            case 'connectBookPage':
                $this->includeDB("BookManagement", "connectBookPage");
                $actionListener = new connectBookPage($this->event);
                break;
            case 'connectBookInfo':
                $this->includeDB("BookManagement", "connectBookInfo");
                $actionListener = new connectBookInfo($this->event);
                break;
            case 'ShowUploadBookPage':
                $this->includeAction("BookManagement", "ShowUploadBookPage");
                $actionListener = new ShowUploadBookPage();
                break;
            case 'connectSearchBookDB':
                $this->includeDB("BookManagement", "connectSearchBookDB");
                $actionListener = new connectSearchBookDB($this->event);
                break;
            case 'connectUploadDB':
                $this->includeDB("BookManagement", "connectUploadDB");
                $actionListener = new connectUploadDB($this->event);
                break;
            case 'connectUploadDB2':
                $this->includeDB("BookManagement", "connectUploadDB2");
                $actionListener = new connectUploadDB2($this->event);
                break;

        }
        $actionListener->actionPerformed();
    }
}

$BookController = new BookController();
$BookController->controllerPerformed();
?>