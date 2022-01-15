<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectContact extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = array();


    function __construct($event)
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
        $this->event = $event;
    }

    public function actionPerformed()
    {
        $this->checkAccount($_SESSION['userID']);
    }

    private function submitProblem($select,$subject,$body,$userID){
        

        $sql = "INSERT INTO problem (problem_id,member_id,problem_subject,problem_body,problem_category)
                values (NULL,'$userID','$subject','$body','$select')";
        $stmt = $this->pdo->exec($sql);
        if($stmt){
            $this->event->receiveEmail($subject,$body);//寄信
            header("Refresh: 0; url=../../2HandBookstore/MainPage/View/index.html");
        }else{
            echo "wrong";
        }

    }
    private function checkAccount($userID)
    {

        $post = $this->event->getPost();
        $select = $post['select'];
        $subject = $post['subject'];
        $body = $post['body'];
        $this->submitProblem($select,$subject,$body,(int)$_SESSION['userID']);
        $stmt = null;

    }
}