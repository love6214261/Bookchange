<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: Ma
 * Date: 2016/7/18
 * Time: 下午 01:45
 */
class ifAddedInRentlist extends ConnectToDB
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
        $bookID = (int)$post['bookID'];

        if ($this->checkIfExist($bookID) == false) {
          echo json_encode("1");
        }
    }

    private function checkIfExist($bookID)
    {
        $sql = "SELECT rent_id,book_id,member_id FROM rent where book_id = ? AND member_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($bookID,$_SESSION['userID']));//array是規定的格式
        $waitData = $stmt->fetch(PDO::FETCH_ASSOC); // key point  line

        if ($waitData['book_id'] == $bookID && $waitData['member_id'] ==$_SESSION['userID'] ) {
            $stmt = null;
            return false;
        } else {
            $stmt = null;
            return true;
        }
    }

}