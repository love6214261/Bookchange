<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/8/16
 * Time: 上午 12:24
 */
include("/../../dbtest.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/12
 * Time: 下午 11:07
 */
class connectOtherBook extends ConnectToDB
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
        $bookISBN = $post['bookISBN'];
        $searched = 0;
        $this->getBooks($bookISBN,$searched);
    }

    private function getBooks($bookISBN,$searched)
    {
        $sql = "";


        $sql = "
      INSERT INTO search(search_isbn,search_before)
      VALUE('$bookISBN','$searched')
    ";

        $stmt = $this->pdo->exec($sql);


        if($stmt)
        {
            echo '新增成功!';
        }
        else
        {
            echo '新增失敗!';
        }
    }
}