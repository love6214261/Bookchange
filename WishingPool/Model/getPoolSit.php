<?php include("/../../ConnectToDB.php");

/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/8/24
 * Time: 下午 10:47
 */
class getPoolSit extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = array();


    function __construct()
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
    }

    public function actionPerformed()
    {
        $sql = "";


        //搜尋資料庫資料
        $sql = "select *, count(wishpool_isbn) as count
from wishpool
group by wishpool_isbn
order by count desc limit 3";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();//array是規定的格式
        $poolData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line


        foreach ($poolData as $data) {
            $dataArray[$data['wishpool_id']] = array(
                'name' => $data['wishpool_bookname'],
                'author' => $data['wishpool_author'],
                'ISBN' => $data['wishpool_isbn'],
                'bookCondition' => $data['wishpool_condition'],
                'price' => $data['wishpool_willingprice'],
                'PBhouse' => $data['wishpool_publishinghouse'],
                'wishingDate' => $data['wishpool_date']
            );
        }
        //var_dump($dataArray);

        $dbh = null;
        echo json_encode($poolData);//用$dataArray格式會錯誤

    }
}

?>

