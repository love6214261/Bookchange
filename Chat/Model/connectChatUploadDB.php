<?php
include("/../../ConnectToDB.php");
//include("/../../Phpmailer/class.phpmailer.php");

/**
 * Created by PhpStorm.
 * User:AllenHsu
 * Date: 2016/7/31
 * Time: 下午 11:07
 */
class connectChatUploadDB extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = null;
    private $conditionPara = array();

    function __construct($event)
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
        $this->event = $event;
    }

    public function actionPerformed()
    {
        $post = $this->event->getPost();
        $msg =$post['msg'];
        $book_id=$post['book_id'];
        $userID = $post['userID'];
        $speakID = $_SESSION['userID'];
        $peopleNum = $post['peopleNum'];
        $peopleID = $post['peopleID'];
        
        
        if ($userID == $speakID) {
            $this->connectChatUploadDB($msg, $book_id,$peopleNum,$peopleID);
            echo json_encode("success");
        }else{
            echo json_encode("NOT Origin");
        }
    }
    

    private function connectChatUploadDB($msg,$book_id,$peopleNum,$peopleID)
    {

        $user=$_SESSION['userID'];

        switch ($peopleID)
        {
            case 'buyer':
                $this->buyer($user,$msg,$book_id,$peopleNum);
                break;
            case 'seller':
                $this->seller($user,$msg,$book_id,$peopleNum);
                break;
        }



    }
    private function buyer($user,$msg,$book_id,$peopleNum){
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間
        switch ($peopleNum)
        {
            case '1':
                $sql = "INSERT INTO chat (member_id,chat_content,chat_time,book_id,chat_sellerRead) values ('$user','$msg','$time','$book_id','0')";
                $stmt = $this->pdo->exec($sql);
                break;
            default:
                $sql = "INSERT INTO chat (member_id,chat_content,chat_time,book_id) values ('$user','$msg','$time','$book_id')";
                $stmt = $this->pdo->exec($sql);

        }

        if ($stmt) {
            $stmt = null;
        }else{
            echo json_encode("no");
        }
    }
    private function seller($user,$msg,$book_id,$peopleNum){
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間
        switch ($peopleNum)
        {
            case '1':
                $sql = "INSERT INTO chat (member_id,chat_content,chat_time,book_id,chat_buyerRead) values ('$user','$msg','$time','$book_id','0')";
                $stmt = $this->pdo->exec($sql);
                break;
            default:
                $sql = "INSERT INTO chat (member_id,chat_content,chat_time,book_id) values ('$user','$msg','$time','$book_id')";
                $stmt = $this->pdo->exec($sql);
                break;
        }

        if ($stmt) {
            $stmt = null;
        }else{
            echo json_encode("no");
        }
    }


}

?>
