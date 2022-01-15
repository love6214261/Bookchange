<?php
include_once ("../ConnectToDB.php");
header("Content-Type:application/json; charset=utf-8");
/*class bookAPI extends ConnectToDB
{
    private $event = null;
    private $pdo = null;
    private $condition = array();


    function __construct()
    {
        parent::__construct();
        $this->pdo = $this->getPDO();
    }
//
//    public function actionPerformed()
//    {
//        $post = $this->event->getPost();
//        $book_id = $post['book_id'];
//        $this->getBooks($book_id);
//    }

    public function getBookInfo($book_name)
    {
        $sql = "";

        //搜尋資料庫資料
        $sql = "SELECT `book_picture`
        FROM `book`
        WHERE book.book_name ='" .$book_name."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $bookData = $stmt->FETCHALL(PDO::FETCH_ASSOC); // key point  line
        $stmt = null;

        //echo json_encode($bookData);//用$dataArray格式會錯誤

    }
}*/
//Decode the parameter
$book_name = urldecode(@$_GET["userinput"]);
//DB Config
$dsn = 'mysql:host=localhost;dbname=secondhandbookstore;charset=utf8';
$pdo = new PDO($dsn, '2hand', 'miranda226');
$pdo->query("SET NAMES 'utf8'");
//echo $pdo->errorCode();
//access one bookInfo
//$sql = "SELECT `book_picture`, `book_name`, `book_author`, `book_id`, `book_publishinghouse`, `member_profile`
//        FROM `book`, `member`
//        WHERE book.book_name = '$book_name' AND book.member_id = member.member_id
//        ";
//access multiple bookInfo
$sql = "SELECT `book_picture`, `book_name`, `book_author`, `book_id`, `book_publishinghouse`, `member_profile`
        FROM `book`, `member`
        WHERE book.book_name  LIKE '%$book_name%' AND book.member_id = member.member_id AND book.book_upcondition ='上架中'
        ORDER BY book_id
        LIMIT 1
        ";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//$query = $stmt->fetch();

$query = $stmt->fetchALL();
$prefixURL ='http://140.112.107.186/2HandBookstore/BookManagement/View/bookInfo.html?value=';
$bookNumber = count($query);
//echo $bookNumber;
//second trial
//$out_prefix = ['messages' =>['attachment' => ['type' => 'template']]];
//$out_prefix['messages']['attachment']['type'] = "template";
//$out_prefix['messages']['attachment']['payload']['template_type'] = "generic";
//$out_prefix['messages']['attachment']['payload']['image_aspect_ratio'] = "square";
//$out_prefix['messages']['attachment']['payload']['elements']['title'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['image_url'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['subtitle'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['button']['type'] = "web_url";
//$out_prefix['messages']['attachment']['payload']['elements']['button']['url'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['button']['title'] = null;
//print_r($out_prefix);
//echo json_encode($out_prefix);

//initial
//$out_prefix['messages']= array();
//$out_prefix['messages']['attachment']['type'] = "template";
//$out_prefix['messages']['attachment']['payload']['template_type'] = "generic";
//$out_prefix['messages']['attachment']['payload']['image_aspect_ratio'] = "square";
//$out_prefix['messages']['attachment']['payload']['elements']['title'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['image_url'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['subtitle'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['button']['type'] = "web_url";
//$out_prefix['messages']['attachment']['payload']['elements']['button']['url'] = null;
//$out_prefix['messages']['attachment']['payload']['elements']['button']['title'] = null;
//
//
//print_r($out_prefix);
//echo json_encode($out_prefix);
switch ($bookNumber){
    case 0:
        echo '{"messages":[{"text":"很抱歉沒有您要找的書"}]}';
    case 1:
        //echo '{"messages":[{"text":"有一本您要找的書"}]}';
        foreach ($query as $row) {
            $pictureURL = $row['book_picture'];
            $bookName = $row['book_name'];
            $bookAuthor = $row['book_author'];
            $bookPublish = $row['book_publishinghouse'];
            $sellerURL = $row['member_profile'];
            $sellID = $row['book_id'];
            $bookURL = $prefixURL . (string)$sellID;
//            $out_prefix['messages']['attachment']['payload']['elements']['title'] = urlencode($bookName);
//            $out_prefix['messages']['attachment']['payload']['elements']['image_url'] = urlencode($pictureURL);
//            $out_prefix['messages']['attachment']['payload']['elements']['subtitle'] = urlencode("作者: '.$bookAuthor.' 出版社: '.$bookPublish.'") ;
//            $out_prefix['messages']['attachment']['payload']['elements']['button']['url'] = urlencode($bookURL);
//            $out_prefix['messages']['attachment']['payload']['elements']['button']['title'] = urlencode("了解更多");
echo ' {
"messages": [
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "image_aspect_ratio": "square",
          "elements":[
            {
              "title":" '.$bookName.' ",
              "image_url":" '.$pictureURL.' ",
              "subtitle":"作者: '.$bookAuthor.' 出版社: '.$bookPublish.' ",
              "buttons":[
                {
                  "type":"web_url",
                  "url":" '.$bookURL. ' ",
                  "title":"了解更多"
                },
                {
                  "type":"web_url",
                  "url":" '.$sellerURL. ' ",
                  "title":"聯絡賣家"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
        }
//        $out_json = json_encode($out_prefix);
//        $out_url = urldecode($out_json);
//        echo $out_url;
//    case 2:
//        foreach ($query as $row) {
//            $pictureURL = $row['book_picture'];
//            $bookName = $row['book_name'];
//            $bookAuthor = $row['book_author'];
//            $bookPublish = $row['book_publishinghouse'];
//            $sellerURL = $row['member_profile'];
//            $sellID = $row['book_id'];
//            $bookURL = $prefixURL . (string)$sellID;
//        }
//    case 3:
//        foreach ($query as $row) {
//            $pictureURL = $row['book_picture'];
//            $bookName = $row['book_name'];
//            $bookAuthor = $row['book_author'];
//            $bookPublish = $row['book_publishinghouse'];
//            $sellerURL = $row['member_profile'];
//            $sellID = $row['book_id'];
//            $bookURL = $prefixURL . (string)$sellID;
//        }

}

/*foreach ($query as $row){
    $pictureURL = $row['book_picture'];
    $bookName = $row['book_name'];
    $bookAuthor = $row['book_author'];
    $bookPublish = $row['book_publishinghouse'];
    $sellerURL = $row['member_profile'];
    $sellID = $row['book_id'];
    $bookURL = $prefixURL . (string)$sellID;
    echo count($query);
    print_r($row);
}*/
if(isset($query[0])){
    $pictureURL = $query[0]['book_picture'];
    $bookName = $query[0]['book_name'];
    $bookAuthor = $query[0]['book_author'];
    $bookPublish = $query[0]['book_publishinghouse'];
    $sellerURL = $query[0]['member_profile'];
    $sellID = $query[0]['book_id'];
    $bookURL = $prefixURL . (string)$sellID;
}
/*if(isset($query[1])){
    $pictureURL1 = $query[1]['book_picture'];
    $bookName1 = $query[1]['book_name'];
    $bookAuthor = $query[1]['book_author'];
    $bookPublish = $query[1]['book_publishinghouse'];
    $sellerURL = $query[1]['member_profile'];
    $sellID = $query[1]['book_id'];
    $bookURL = $prefixURL . (string)$sellID;
}

if(isset($query[2])){
    $pictureURL2 = $query[2]['book_picture'];
    $bookName2 = $query[2]['book_name'];
    $bookAuthor = $query[2]['book_author'];
    $bookPublish = $query[2]['book_publishinghouse'];
    $sellerURL = $query[2]['member_profile'];
    $sellID = $query[2]['book_id'];
    $bookURL = $prefixURL . (string)$sellID;
}*/


//$pictureURL = $query['book_picture'];
//$bookName = $query['book_name'];
//$bookAuthor = $query['book_author'];
//$bookPublish = $query['book_publishinghouse'];
//$sellerURL = $query['member_profile'];
//$sellID = $query['book_id'];
//$bookURL = $prefixURL . (string)$sellID;

/*foreach($query as $row){
    echo $row['book_picture'].'<br>';
}*/

//$word = urlencode(@$_GET["userinput"]);
//$thnx2 = '{"messages":[{"text":"'.$book_name.'"}]}';
//echo $thnx2;

//$apiObject = new bookAPI;
//$pictureURL = $apiObject->getBookInfo($word);
//$thnx3 = '{"messages":[{"text":"'.$pictureURL.'"}]}';



//$thnx4 = '{
// "messages": [
//    {
//      "attachment":{
//        "type":"template",
//        "payload":{
//          "template_type":"generic",
//          "image_aspect_ratio": "square",
//          "elements":[
//            {
//              "title":" '.$bookName.' ",
//              "image_url":" '.$pictureURL.' ",
//              "subtitle":"作者: '.$bookAuthor.' 出版社: '.$bookPublish.' ",
//              "buttons":[
//                {
//                  "type":"web_url",
//                  "url":" '.$bookURL. ' ",
//                  "title":"了解更多"
//                },
//                {
//                  "type":"web_url",
//                  "url":" '.$sellerURL. ' ",
//                  "title":"聯絡賣家"
//                }
//              ]
//            }
//          ]
//        }
//      }
//    }
//  ]
//}';
//echo $thnx4;
//echo $pictureURL;