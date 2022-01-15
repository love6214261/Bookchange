<?php
include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/7/11
 * Time: 上午 12:53
 */
class connectUploadEvaluateDB extends ConnectToDB
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

        $book_id=$post['book_id'];
        $state='評價中';

        $this->uploadTrade($book_id,$state);
    }

    private function uploadTrade($book_id,$state)
    {
        $sql = "";

        $sql_b = "
    UPDATE book
    SET book_upcondition='$state'
    WHERE book_id='$book_id' 
    ";
        $sql_t = "
    UPDATE trade
    SET trade_condition='$state'
    WHERE book_id='$book_id' 
    ";
        
        $stmt_b = $this->pdo->exec($sql_b);
        $stmt_t = $this->pdo->exec($sql_t);

        if($stmt_b && $stmt_t)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}