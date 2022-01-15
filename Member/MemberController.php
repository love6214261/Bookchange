<?php
include "../commonController.php";
/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/5
 * Time: 下午 01:42
 */
class MemberController extends commonController
{
    private $action = null;

    function __construct() {
        parent::__construct();
        $this->action = $this->event->getAction();

    }

    public function controllerPerformed() {
        switch ($this->action) {
            case 'ShowProfilePage':
                $this->includeAction("Member","memberAbout/ShowProfilePage");
                $actionListener = new ShowProfilePage();
                break;
            case 'ShowTradePage':
                $this->includeAction("Member","ShowTradePage");
                $actionListener = new ShowTradePage();
                break;
            /*Created by Peng 7/31*/
            //顯示我的追蹤清單
            case 'ShowFollowList':
                $this->includeAction("Member","bookAbout/ShowFollowList");
                $actionListener = new ShowFollowList();
                break;
            case 'ShowBookManagement':
                $this->includeAction("Member","ShowBookManagement");
                $actionListener = new ShowBookManagement();
                break;
            case 'ShowWishList':
                $this->includeAction("Member","buyer/ShowWishList");
                $actionListener = new ShowWishList();
                break;
            case 'ShowChangePassword':
                $this->includeAction("Member","memberAbout/ShowChangePassword");
                $actionListener = new ShowChangePassword();
                break;
            case 'ShowChatRoomInfo':
                $this->includeAction("Member","ShowChatRoomInfo");
                $actionListener = new ShowChatRoomInfo();
                break;
            //買家專區
            case 'ShowBuyOrder':
                $this->includeAction("Member","buyer/ShowBuyOrder");
                $actionListener = new ShowBuyOrder();
                break;
            case 'ShowSellOrder':
                $this->includeAction("Member","ShowSellOrder");
                $actionListener = new ShowSellOrder();
                break;
            case 'ShowMemberCenter':
                $this->includeAction("Member","memberAbout/ShowMemberCenter");
                $actionListener = new ShowMemberCenter();
                break;
            /*Created by Peng 8/4 16:50*/
            case 'ShowActivePage':
                $this->includeAction("Member","memberAbout/ShowActivePage");
                $actionListener = new ShowActivePage();
                break;
            case 'ShowActiveFinish':
                $this->includeAction("Member","memberAbout/ShowActiveFinish");
                $actionListener = new ShowActiveFinish();
                break;
            case 'ShowViolationPage':
                $this->includeAction("Member","memberAbout/ShowViolationPage");
                $actionListener = new ShowViolationPage();
                break;
            //seller 上傳及下架
            case 'ShowUploadBookManagementPage':
                $this->includeAction("Member", "seller/ShowUploadBookManagementPage");
                $actionListener = new ShowUploadBookManagementPage();
                break;
            //seller 訂單
            case 'ShowSellerOrderPage':
                $this->includeAction("Member", "seller/ShowSellerOrderPage");
                $actionListener = new ShowSellerOrderPage();
                break;
            case 'ShowViolation':
                $this->includeAction("Member","memberAbout/ShowViolation");
                $actionListener = new ShowViolation();
                break;

            //Connect
            //註冊會員
            case 'connectSignup':
                $this->includeDB("Member", "memberAbout/connectSignup");
                $actionListener = new connectSignup($this->event);
                break;
            case 'connectProfilePage':
                $this->includeDB("Member","memberAbout/connectProfilePage");
                $actionListener = new connectProfilePage($this->event);
                break;
            case 'connectProfileModified':
                $this->includeDB("Member","memberAbout/connectProfileModified");
                $actionListener = new connectProfileModified($this->event);
                break;

            //查看交易狀況頁面
            case 'connectTradePage':
                $this->includeDB("Member","buyer/connectTradePage");
                $actionListener = new connectTradePage($this->event);
                break;
        
            case 'connectBookManagement':
                $this->includeDB("Member","connectBookManagement");
                $actionListener = new connectBookManagement($this->event);
                break;
            /*許願池相關*/
            case 'connectWishMatch':
                $this->includeDB("Member","buyer/connectWishMatch");
                $actionListener = new connectWishMatch($this->event);
                break;

            //修改密碼相關
            case 'connectChangePassword':
                $this->includeDB("Member","memberAbout/connectChangePassword");
                $actionListener = new connectChangePassword($this->event);
                break;
            case 'connectChatRoomInfo':
                $this->includeDB("Member","connectChatRoomInfo");
                $actionListener = new connectChatRoomInfo($this->event);
                break;
            /*追蹤清單相關*/
            case 'connectTraceNum':
                $this->includeDB("Member","memberAbout/connectTraceNum");
                $actionListener = new connectTraceNum($this->event);
                break;
            case 'connectFollowList':
                $this->includeDB("Member","bookAbout/connectFollowList");
                $actionListener = new connectFollowList($this->event);
                break;
            //seller 上傳及下架
            case 'connectShowUploadBook':
                $this->includeDB("Member", "seller/connectShowUploadBook");
                $actionListener = new connectShowUploadBook($this->event);
                break;
            case 'connectDownBook':
                $this->includeDB("Member", "seller/connectDownBook");
                $actionListener = new connectDownBook($this->event);
                break;
            //seller 訂單
            case 'connectOnsale':
                $this->includeDB("Member", "seller/connectOnsale");
                $actionListener = new connectOnsale($this->event);
                break;
            //seller 訂單+(trade+book)
            case 'connectBookAndTrade':
                $this->includeDB("Member", "seller/connectBookAndTrade");
                $actionListener = new connectBookAndTrade($this->event);
                break;
            //check評價有沒有
            case 'connectCheckEvaluation':
                $this->includeDB("Member", "seller/connectCheckEvaluation");
                $actionListener = new connectCheckEvaluation($this->event);
                break;
            //顯示等待清單
            case 'connectWaitChoice':
                $this->includeDB("Member", "seller/connectWaitChoice");
                $actionListener = new connectWaitChoice($this->event);
                break;
            //通知中心
            case 'connectInform':
                $this->includeDB("Member","memberAbout/connectInform");
                $actionListener = new connectInform($this->event);
                break;
            case 'connectInformData':
                $this->includeDB("Member","memberAbout/connectInformData");
                $actionListener = new connectInformData($this->event);
                break;

            //會員開通
            case 'connectActive':
                $this->includeDB("Member","memberAbout/connectActive");
                $actionListener = new connectActive($this->event);
                break;
            //接收APP組的會員資料
            case 'connectAPP':
                $this->includeDB("Member","memberAbout/connectAPP");
                $actionListener = new connectAPP($this->event);
                break;
            case 'connectEmail':
                $this->includeDB("Member","memberAbout/connectEmail");
                $actionListener = new connectEmail($this->event);
                break;

            //賣家交易中
            case 'connectTrading':
                $this->includeDB("Member", "seller/connectTrading");
                $actionListener = new connectTrading($this->event);
                break;
            //上傳未上架書籍
            case 'connectUploadNot':
                $this->includeDB("Member", "seller/connectUploadNot");
                $actionListener = new connectUploadNot($this->event);
                break;

        }

        $actionListener->actionPerformed();
    }

}

$MemberController = new MemberController();
$MemberController->controllerPerformed();
?>

