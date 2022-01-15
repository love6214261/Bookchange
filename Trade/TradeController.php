<?php
include "../commonController.php";
/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/18
 * Time: 下午 01:22
 */
class TradeController extends commonController
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
            case 'connectWaitList':
                $this->includeDB("Trade", "connectWaitList");
                $actionListener = new connectWaitList($this->event);
                break;
            case 'connectUploadTradeDB':
                $this->includeDB("Trade", "connectUploadTradeDB");
                $actionListener = new connectUploadTradeDB($this->event);
                break;
            case 'connectUploadEvaluateDB':
                $this->includeDB("Trade", "connectUploadEvaluateDB");
                $actionListener = new connectUploadEvaluateDB($this->event);
                break;
            case 'connectUploadEndDB':
                $this->includeDB("Trade", "connectUploadEndDB");
                $actionListener = new connectUploadEndDB($this->event);
                break;


        }
        $actionListener->actionPerformed();
    }
}

$TradeController = new TradeController();
$TradeController->controllerPerformed();

?>


