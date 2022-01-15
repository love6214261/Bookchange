<?php
include("/../../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectDownBook extends ConnectToDB
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
        $post = $this->event->getPost();

        $downbook = $post['downbook'];
        $state = "下架";

        $this->DownBook($downbook,$state);
    }

    private function DownBook($downbook,$state)
    {
        $sql = "";
        //下架書
        $sql= "
    UPDATE book
    SET book_upcondition='$state'
    WHERE book_id='$downbook' 
    ";

        $stmt = $this->pdo->exec($sql);


        if($stmt)
        {
            echo json_encode($downbook);
        }
        else
        {
            echo '下架失敗!';
        }

    }
}