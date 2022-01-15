<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/18
 * Time: 下午 01:45
 */
class connectWaitList extends ConnectToDB
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
        $userID = (int)$post['userID'];
        $bookID = (int)$post['bookID'];
        $RorB = $post['RorB'];
        $allowtime = (int)$post['allowtime'];

        if ($this->checkIfExist($userID, $bookID) == true) {
            $this->addList($userID, $bookID,$RorB,$allowtime);
            echo json_encode(array("msg"=>'已加入排隊，請耐心等候賣家審核'));
        }else{
            echo json_encode(array("msg"=>'重複加入排隊，請耐心等候賣家審核'));
        }
    }

    private function checkIfExist($userID, $bookID)
    {
        $sql = "SELECT book_id,member_id
                FROM waitlist 
                where book_id = ? AND member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($bookID, $userID));//array是規定的格式
        $waitData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line

        if ($waitData['book_id'] == $bookID && $waitData['member_id'] == $userID) {
            $stmt = null;
            return false;
        } else {
            $stmt = null;
            return true;
        }
    }

    private function addList($userID, $bookID,$RorB,$allowtime)
    {
        $sql = "INSERT INTO waitlist (book_id,member_id,waitlist_RorB,waitlist_dealtime) VALUES ('$bookID','$userID','$RorB','$allowtime')";

        $stmt = $this->pdo->exec($sql);

        if ($stmt) {
        }
    }
}