

<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/18
 * Time: 下午 01:45
 */
class connectRentBook extends ConnectToDB
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

        if ($this->checkIfExist($userID, $bookID) == true) {
            $this->addList($userID, $bookID);
        }else{
            echo json_encode(array("msg"=>'重複提出租書要求，請耐心等候賣家審核'));
        }
    }

    private function checkIfExist($userID, $bookID)
    {
        $sql = "SELECT rent_id,book_id,member_id FROM rent where book_id = ? AND member_id = ?";
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

    private function addList($userID, $bookID)
    {
        $sql = "INSERT INTO rent  (rent_id,book_id,member_id) VALUES (NULL,'$bookID','$userID')";

        $stmt = $this->pdo->exec($sql);
        if ($stmt) {
            echo json_encode(array("msg"=>'已提出租書要求，請耐心等候賣家審核'));
        }
    }
}