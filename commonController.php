<?php
header("Content-Type:text/html; charset=utf-8");
date_default_timezone_set("Asia/Taipei");
include_once (dirname(__FILE__) ."/Event.php");
session_start();
/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/2
 * Time: 下午 12:31
 */
class commonController
{
    protected $event = null;
    
    function __construct()
    {
        $this->event = new event($_GET,$_POST);
    }
    // 進行網頁頁面的跳轉
    protected function includeView($module,$file)
    {
        $includePath = "../".$module."/View/".$file.".php";
        include $includePath;
    }
    
    // 各網頁後端動作
    protected function includeAction($module,$file)
    {
        $includePath = "../".$module."/Control/".$file.".php";
        include $includePath;
    }
    //資料庫的動作
    protected function includeDB($module,$file)
    {
        $includePath = "../".$module."/Model/".$file.".php";
        include $includePath;
    }
}

?>