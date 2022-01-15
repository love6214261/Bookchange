<?php
class User {
    private $dbHost     = "140.112.107.186";
    private $dbUsername = "2hand";
    private $dbPassword = "miranda226";
    private $dbName     = "secondhandbookstore";
    private $userTbl    = 'member';
    
    function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            $conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
			mysqli_query($conn,"SET NAMES utf8");
            if($conn->connect_error){
                die("Failed to connect with MySQL: " . $conn->connect_error);
            }else{
                $this->db = $conn;
            }
        }
    }
    
    function checkUser($userData = array()){
        if(!empty($userData)){
            // Check whether user data already exists in database
            $prevQuery = "SELECT * FROM ".$this->userTbl." WHERE member_account = '".$userData['email']."'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                // Update user data if already exists
				$query = "UPDATE ".$this->userTbl." SET member_name ='".$userData['first_name']."' WHERE member_account = '".$userData['email']."'";
                $query2 = "UPDATE ".$this->userTbl." SET member_profile ='".$userData['link']."' WHERE member_account = '".$userData['email']."'";
                $update = $this->db->query($query);
                $update2 = $this->db->query($query2);
            }else{
                // Insert user data
                $query = "INSERT INTO ".$this->userTbl." SET member_account = '".$userData['email']."', member_name ='".$userData['first_name']."' ,member_profile ='".$userData['link']."'" ;
                $insert = $this->db->query($query);
            }

            // Get user data from the database
            //$result = $this->db->query($prevQuery);
			//$userData = $result->fetch_assoc();
        }

        // Return user data
        return $userData;
    }
}
?>
