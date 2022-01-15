<?php
/**
 * Created by PhpStorm.
 * User: AllenHsu
 * Date: 2016/8/5
 * Time: 下午 04:12
 */
include("/../../ConnectToDB.php");
class connectUploadEvaluate extends ConnectToDB
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

        $score = $post['score'];//評價分數
        $result = $post['result'];//評價原因
        $advise= $post['advise'];//評價建議
        $book_id = $post['book_id'];
        $buyer=$post['userID'];
        date_default_timezone_set("Asia/Taipei");
        $time = date("Y") . date("m") . date("d") . date("h") . date("i") . date("s"); //取得當前時間

        $this->uploadEvaluate($score,$result,$advise,$book_id,$buyer,$time);
    }

    private function uploadEvaluate($score,$result,$advise,$book_id,$buyer,$time)
    {
       $userID=$_SESSION['userID'];
        $sql = "
      INSERT INTO evaluation (evaluation_score,evaluation_date,evaluation_condition,evaluation_advise,member_id,trade_id,evaluation_evaluator,evaluation_read)
      VALUE ('$score','$time','$result','$advise','$buyer',null,'$userID','0')
    ";
        //更新類別和賣方 //+buyer_id

        $sql_u = "
    UPDATE evaluation
    SET trade_id=
    (SELECT trade_id
     FROM trade
     WHERE book_id='$book_id'
    )
    WHERE member_id='$buyer' AND evaluation_date='$time'
    ";

        $sql_m="
    UPDATE member
    SET member_score=
    (SELECT AVG (evaluation_score)
     FROM evaluation
     WHERE member_id='$buyer'
    ),
    member_tradeNum = member_tradeNum+1
    
    WHERE member_id='$buyer' 
        ";

        $stmt = $this->pdo->exec($sql);
        $stmt_u = $this->pdo->exec($sql_u);
        $stmt_m = $this->pdo->exec($sql_m);

        if($stmt && $stmt_u && $stmt_m)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }

    }
}