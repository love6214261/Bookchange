<?php 

include "../commonController.php";

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/8
 * Time: 下午 09:02
 */
class ChatController extends commonController
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
            case 'connectChatUploadDB':
                $this->includeDB("Chat", "connectChatUploadDB");
                $actionListener = new connectChatUploadDB($this->event);
                break;
            case 'connectChatDB':
                $this->includeDB("Chat", "connectChatDB");
                $actionListener = new connectChatDB($this->event);
                break;
            case 'connectChatCheckID':
                $this->includeDB("Chat", "connectChatCheckID");
                $actionListener = new connectChatCheckID($this->event);
                break;
        }
        $actionListener->actionPerformed();
    }
}

$ChatController = new ChatController();
$ChatController->controllerPerformed();
?>