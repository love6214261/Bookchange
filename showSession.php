<?php session_start();
//<!--catch session-->
header("Content-Type:text/html; charset=UTF-8");
$sessionArray = array(
    "session" => $_SESSION["username"],
    "userID" => $_SESSION["userID"],
    "userAccount" => $_SESSION["userAccount"],
    "acNum"=>"0",
    'member_score'=>$_SESSION['user_Score']
);
echo json_encode($sessionArray);

?>

