<?php 

    define('DB_SERVER', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'fanclub_db');
    
    class DB_con {

        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL : " . mysqli_connect_error();
            }
        }

        public function fetchdata() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM member");
            return $result;
        }

        public function update($firstname, $lastname, $email, $NationalID) {
            $result = mysqli_query($this->dbcon, "UPDATE member SET 
                Fname = '$firstname',
                Lname = '$lastname',
                email = '$email',
                WHERE NationalID = '$NationalID'
            ");
            return $result;
        }

        public function delete($NationalID) {
            $deleterecord = mysqli_query($this->dbcon, "DELETE FROM member WHERE NationalID = '$NationalID'");
            return $deleterecord;
        }

    }
    
    class Member extends DB_con{
        public function insertUser($NationalID, $Title_name, $Fname, $Lname, $Sex, $Tel, $email, $Pic, $Username, $Password){
        }

        public function getUserInfo($NationalID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM member WHERE NationalID = '$NationalID'");
            return $result;
        }
    }

    class Leader extends Member{
        public function insertLeader(){

        }

        public function getLeaderInfo($NationalID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM leader WHERE L_NationalID = '$NationalID'");
            return $result;
        }
    }

    class Leader_location extends Leader{
        public function insertLeaderLocation(){

        }

        public function getLocation($postNo){
            $result = mysqli_query($this->dbcon, "SELECT * FROM leader_location WHERE PostNo = '$postNo'");
            return $result;
        }
    }

    class Bank extends Leader{
        public function insertBank(){

        }

        public function getBank($BankID){
            $result = mysqli_query($this->dbcon, "SELECT * FROM bank WHERE BankID = '$BankID'");
            return $result;
        }
    }

?>