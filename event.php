<?php
include("Phpmailer/class.phpmailer.php");
/**
 * Created by PhpStorm.
 * User: HanLing Shen
 * Date: 2016/7/2
 * Time: 下午 12:42
 */
class event
{
    private $get = null;
    private $post = null;
    private $parameter = null;
    private $receiver = null;
    private $receiverMail = null;
    
    function __construct($get,$post)
    {
        $this->get = $get;
        $this->post = $post;
    }
    
    public function getGet()
    {
        return $this->get;
    }

    public function getPost()
    {
        return $this->post;
    }
    
    public function getAction()
    {
        $action = $this->get;
        return $action['action'];
    }
    
    public function getPostParameter($key)
    {
    return $this->post[$key];
    }
    
    public function  setPostParameter($key,$keyvalue)
    {
        $this->post[$key]=$keyvalue;
    }

    public function sendEmail($receiver,$receiveMail,$subject,$body){
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "twchildrens@gmail.com";
        $mail->Password = "miranda226";
//這邊是你的gmail帳號和密碼
        $mail->FromName = "台灣囝仔";
// 寄件者名稱(你自己要顯示的名稱)
        $webmaster_email = "twchildrens@gmail.com";
//回覆信件至此信箱
        $email = $receiveMail;
// 收件者信箱
        $name = $receiver;
// 收件者的名稱or暱稱
        $mail->From = $webmaster_email;


        $mail->AddAddress($email, $name);
        $mail->AddReplyTo($webmaster_email, "Squall.f");
        $mail->WordWrap = 50;
//每50行斷一次行
//$mail->AddAttachment("/XXX.rar");
// 附加檔案可以用這種語法(記得把上一行的//去掉)
        $mail->IsHTML(true); // send as HTML

        $mail->Subject = $subject;
// 信件標題
        $mail->Body = $body;
//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
        // $mail->AltBody = "信件內容";
//信件內容(純文字版)
        $mail->Send();

    }

    public function receiveEmail($subject,$body){
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSMTP();
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "twchildrens@gmail.com";
        $mail->Password = "miranda226";
//這邊是你的gmail帳號和密碼
        $mail->FromName = "台灣囝仔";
// 寄件者名稱(你自己要顯示的名稱)
        $webmaster_email = "twchildrens@gmail.com";
//回覆信件至此信箱
        $email = "twchildrens@gmail.com";
// 收件者信箱
        $name = "用戶問題";
// 收件者的名稱or暱稱
        $mail->From = $webmaster_email;


        $mail->AddAddress($email, $name);
        $mail->AddReplyTo($webmaster_email, "Squall.f");
        $mail->WordWrap = 50;
//每50行斷一次行
//$mail->AddAttachment("/XXX.rar");
// 附加檔案可以用這種語法(記得把上一行的//去掉)
        $mail->IsHTML(true); // send as HTML

        $mail->Subject = $subject;
// 信件標題
        $mail->Body = $body;
//信件內容(html版，就是可以有html標籤的如粗體、斜體之類)
        // $mail->AltBody = "信件內容";
//信件內容(純文字版)
        $mail->Send();

    }
}

?>