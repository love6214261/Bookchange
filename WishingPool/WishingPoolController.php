<?php
include "../commonController.php";
/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/9
 * Time: 上午 02:47
 */
class WishingPoolController extends commonController
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
            case 'ShowPoolPage':
                $this->includeAction("WishingPool", "ShowPoolPage");
                $actionListener = new ShowPoolPage();
                break;
            case 'ShowWishPage':
                $this->includeAction("WishingPool", "ShowWishPage");
                $actionListener = new ShowWishPage();
                break;
            case 'connectPool':
                $this->includeDB("WishingPool", "connectPool");
                $actionListener = new connectPool($this->event);
                break;
            case 'connectWish':
                $this->includeDB("WishingPool", "connectWish");
                $actionListener = new connectWish($this->event);
                break;
            case 'getPoolSit':
                $this->includeDB("WishingPool", "getPoolSit");
                $actionListener = new getPoolSit($this->event);
                break;

        }
        $actionListener->actionPerformed();
    }
}

$WishingPoolController = new WishingPoolController();
$WishingPoolController->controllerPerformed();
?>